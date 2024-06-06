[...document.querySelectorAll(".caruosel .slides")].map(slider => {
  if(slider.getAttribute("data-loaded-js") == "1") return;
  slider.setAttribute("data-loaded-js", "1");
  
  const slides = [...slider.querySelectorAll(".slide")];
  if(slides.length < 2) return;

  const before_slide = () => {
    slides.map(slide => {
      slide.classList.remove("show");
      slide.classList.remove("hide");
      slide.classList.remove("backwards");
    });
  };

  const get_current_slide_index = () => slides.findIndex(slide => slide.classList.contains("active"));

  const slide_func = (from_index, to_index, direction = "next") => {
    setTimeout(() => {
      slides[from_index].classList.remove("active");
      slides[to_index].classList.add("active");
      slides[direction === "next" ? from_index : to_index].classList.add("hide");
      slides[direction === "next" ? to_index: from_index].classList.add("show");
      if(direction !== "next") {
        slides[from_index].classList.add("backwards");
        slides[to_index].classList.add("backwards");
      }
    });
  }

  const next_slide = () => {
    before_slide();
    const active_index = get_current_slide_index();
    const next_index = (active_index + 1) % slides.length;
    slide_func(active_index, next_index, "reverse");
  };

  const prev_slide = () => {
    before_slide();
    const active_index = get_current_slide_index();
    const next_index = (active_index - 1 + slides.length) % slides.length;
    slide_func(active_index, next_index);
  };

  slides.map(slide => {
    const controls = slide.querySelector(".controls");
    const next = controls.querySelector(".right");
    next.addEventListener("click", () => {
      next_slide();
      restart_interval();
    });
    const prev = controls.querySelector(".left");
    prev.addEventListener("click", () => {
      prev_slide();
      restart_interval();
    });
  });

  const interval = 10000;
  let interval_id = -1;
  const restart_interval = () => {
    clearInterval(interval_id);
    interval_id = setInterval(next_slide, interval);
  };
  restart_interval();
});
