<?php
function wrap_admin($content) {
  $component = \component(__DIR__)
    ->css_file("admin_wrapper.css")
    ->js_file("admin_wrapper.js");
?>
  <head>
    <!-- Cannot use this because ckeditor adds extra scripts -->
    <!-- <script src="/api/compress?url=<?=urlencode("/ckeditor/ckeditor.js")?>"></script> -->
    <!-- consider changing framework -->
    <script src="/static/ckeditor/ckeditor.js"></script>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTI0IiBoZWlnaHQ9IjEyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2ZXJzaW9uPSIxLjEiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIj4KIDxnPgogIDx0aXRsZT5MYXllciAxPC90aXRsZT4KICA8ZyBpZD0ic3ZnXzEiPgogICA8cGF0aCBkPSJtMTc3LjM1OTQ4LDc1LjYwMzg2Yy04LjQzODc2LDAgLTEzLjA5NDYzLC01LjM4MzM0IC0xMS45MzA2NywtMTMuMDk0NjNjMS4zMDk0NywtNy44NTY3NyA3LjcxMTI5LC0xMy4wOTQ2MyAxNi4wMDQ1NSwtMTMuMDk0NjNjNC4zNjQ4OCwwIDguMjkzMjcsMi4wMzY5NSAxMC42MjEyLDUuMDkyMzZsOC4xNDc3NywtNi42OTI4MWMtNC4zNjQ4OCwtNC45NDY4NiAtMTAuNjIxMiwtNy40MjAyOSAtMTcuMzE0MDEsLTcuNDIwMjljLTEzLjY3NjYxLDAgLTI1LjYwNzI3LDkuMTY2MjQgLTI3LjY0NDIyLDIyLjExNTM3Yy0yLjAzNjk0LDEzLjA5NDYzIDYuNjkyODEsMjIuMTE1MzggMjAuNTE0OTIsMjIuMTE1MzhjNi45ODM4MSwwIDEzLjk2NzYxLC0yLjkwOTkyIDIwLjA3ODQzLC03LjcxMTI4bC01LjgxOTgzLC02LjY5MjgxYy00LjIxOTM4LDMuNzgyODkgLTguNTg0MjYsNS4zODMzNCAtMTIuNjU4MTQsNS4zODMzNG01NC43MDY0NSwtMzQuNzczNTFjMCwwIC0xLjc0NTk1LC0wLjI5MDk5IC0xLjg5MTQ1LC0wLjI5MDk5Yy0xLjg5MTQ0LC0wLjI5MSAtMy45MjgzOSwtMC4xNDU1IC01LjgxOTgzLDBjLTEuNzQ1OTUsMC4xNDU0OSAtMy40OTE5LDAuNDM2NDggLTUuMjM3ODYsMS4wMTg0N2MtMS40NTQ5NSwwLjQzNjQ5IC0zLjA1NTQxLDEuMDE4NDcgLTQuMzY0ODcsMS44OTE0NGwwLjI5MDk5LC0yLjAzNjk0bC05Ljg5MzcyLDBsLTYuNjkyODEsNDIuMTkzODFsOS44OTM3MiwwbDMuOTI4MzksLTI0LjU4ODgxYzAuMTQ1NDksLTEuNDU0OTYgMC43Mjc0OCwtMi43NjQ0MiAxLjQ1NDk2LC0zLjkyODM5YzAuNzI3NDgsLTEuMTYzOTYgMS43NDU5NSwtMi4xODI0MyAyLjkwOTkxLC0yLjkwOTkxYzEuMTYzOTcsLTAuODcyOTggMi4zMjc5NCwtMS40NTQ5NiAzLjYzNzQsLTEuODkxNDVjMS4zMDk0NywtMC40MzY0OSAyLjYxODkzLC0wLjcyNzQ4IDQuMDczODksLTAuODcyOThjMS44OTE0NCwtMC4xNDU0OSAzLjkyODM5LDAgNS44MTk4MywwLjQzNjQ5YzAsMCAwLjE0NTUsMCAwLjE0NTUsMGMwLjI5MDk5LDAgMS43NDU5NSwtOS4wMjA3NCAxLjc0NTk1LC05LjAyMDc0bTM0LjYyODAyLDMuMjAwOTFjLTIuNzY0NDIsLTIuMzI3OTQgLTYuOTgzOCwtMy42Mzc0IC0xMS45MzA2NiwtMy42Mzc0Yy0xMi4zNjcxNSwwIC0yMy41NzAzNCw4Ljg3NTI1IC0yNS43NTI3OCwyMS45Njk4OGMtMi4wMzY5NCwxMy4wOTQ2MyA2LjU0NzMyLDIxLjk2OTg4IDE4LjQ3Nzk4LDIxLjk2OTg4YzUuMzgzMzUsMCA5Ljg5MzcyLC0wLjcyNzQ4IDEzLjY3NjYxLC0zLjM0NjQxbC0wLjI5MDk5LDIuMzI3OTRsOS4wMjA3NSwwbDYuNTQ3MzEsLTQxLjkwMjgybC05LjMxMTc0LDBsLTAuNDM2NDgsMi42MTg5M3ptLTIuMDM2OTQsMTguMzMyNDhsMCwwYy0xLjMwOTQ3LDguMDAyMjcgLTcuMjc0OCwxMy41MzExMiAtMTQuOTg2MDgsMTMuNTMxMTJjLTcuODU2NzgsMCAtMTIuMzY3MTUsLTUuODE5ODQgLTExLjA1NzY5LC0xMy42NzY2MmMxLjMwOTQ3LC03Ljg1Njc4IDcuNTY1NzksLTEzLjM4NTYyIDE1LjI3NzA3LC0xMy4zODU2MmM3LjcxMTI4LDAuMTQ1NSAxMS45MzA2Niw1LjUyODg0IDEwLjc2NjcsMTMuNTMxMTJsMCwwem01Ny40NzA4NywtMjAuOTUxNDFsMS44OTE0NCwtMTEuOTMwNjZsLTExLjM0ODY3LDguMTQ3NzdsLTAuNTgxOTksMy45MjgzOWwtMTIuODAzNjMsMGwxLjMwOTQ2LC04LjAwMjI4YzAuNzI3NDgsLTMuNzgyODkgNC44MDEzNiwtMy42MzczOSA0LjgwMTM2LC0zLjYzNzM5bDQuODAxMzcsMGwxLjQ1NDk1LC04LjcyOTc2bC01LjUyODg0LDBsLTEuMzA5NDYsMGMtMTMuNTMxMTIsMCAtMTMuOTY3NjEsMTAuNDc1NzEgLTEzLjk2NzYxLDEwLjQ3NTcxbC0wLjg3Mjk3LDQuOTQ2ODZsLTAuNzI3NDgsNC45NDY4NmwtMC44NzI5OCwwbC0xMS4wNTc2OCw4LjcyOTc1bDEwLjQ3NTcsMGwtNi42OTI4MSw0Mi42MzAyOWwxMC4xODQ3MSwwbDYuNjkyODEsLTQyLjc3NTc5bDEyLjgwMzY0LDBsLTUuMjM3ODUsMzMuNDY0MDZsMTAuMDM5MjEsMGw1LjIzNzg2LC0zMy40NjQwNmwxMi41MTI2NCwwbDEuNDU0OTYsLTguNzI5NzVsLTEyLjY1ODE0LDB6bTI2LjkxNjc0LDIxLjA5NjljMi4wMzY5NCwtMTIuOTQ5MTMgMTMuODIyMSwtMjIuMTE1MzcgMjcuNjQ0MjEsLTIyLjExNTM3YzYuNjkyODEsMCAxMi45NDkxNCwyLjYxODkzIDE3LjMxNDAxLDcuNDIwMjlsLTguMTQ3NzcsNi42OTI4MWMtMi4zMjc5MywtMy4wNTU0MSAtNi4yNTYzMiwtNS4wOTIzNiAtMTAuNjIxMTksLTUuMDkyMzZjLTguMjkzMjcsMCAtMTQuNjk1MDksNS4zODMzNSAtMTYuMDA0NTUsMTMuMDk0NjNjLTEuMTYzOTcsNy43MTEyOSAzLjQ5MTksMTMuMDk0NjMgMTEuOTMwNjYsMTMuMDk0NjNjNC4wNzM4OSwwIDguNDM4NzYsLTEuNjAwNDUgMTIuNjU4MTQsLTUuMzgzMzRsNS44MTk4NCw2LjY5MjgxYy02LjExMDgzLDQuOTQ2ODYgLTEzLjA5NDYzLDcuNzExMjggLTIwLjA3ODQ0LDcuNzExMjhjLTEzLjgyMjEsMCAtMjIuNTUxODYsLTkuMDIwNzUgLTIwLjUxNDkxLC0yMi4xMTUzOG0xMTcuODUxNjYsLTQuNTEwMzdsLTMuOTI4MzksMjUuNjA3MjhsLTkuODkzNzIsMGwzLjkyODM5LC0yNC44Nzk4YzEuMDE4NDcsLTUuODE5ODMgLTIuMTgyNDQsLTkuMzExNzQgLTcuODU2NzgsLTkuMzExNzRjLTUuOTY1MzMsMCAtMTEuOTMwNjYsMy42Mzc0IC0xMi44MDM2NCw5LjYwMjczbC0zLjkyODM5LDI0LjU4ODgxbC05Ljg5MzcxLDBsMy45MjgzOCwtMjQuODc5OGMwLjg3Mjk4LC01LjY3NDM0IC0yLjQ3MzQzLC05LjE2NjI0IC03Ljg1Njc3LC05LjMxMTc0Yy01LjUyODg1LDAuMjkxIC0xMS45MzA2NywzLjc4MjkgLTEyLjgwMzY0LDkuNjAyNzNsLTMuOTI4MzksMjQuNTg4ODFsLTkuODkzNzIsMGw2LjY5MjgxLC00Mi4xOTM4MWw5Ljg5MzcyLDBsLTAuMjkwOTksMi4wMzY5NGMzLjM0NjQsLTIuMDM2OTQgNy4xMjkzLC0yLjkwOTkxIDExLjkzMDY2LC0zLjA1NTQxbDAuODcyOTgsMGM2LjExMDgyLDAgMTEuMDU3NjgsMi40NzM0MyAxMy42NzY2MSw2LjY5MjgxYzQuMDczODgsLTQuMjE5MzggMTAuMzMwMjEsLTYuNjkyODEgMTYuNTg2NTMsLTYuNjkyODFjMTAuNzY2NywwIDE3LjMxNDAxLDcuMTI5MyAxNS41NjgwNiwxNy42MDVtLTAuNDM2NDksMjAuNTE0OTJsNi4xMTA4MywtNy41NjU3OGMzLjM0NjQsMi42MTg5MiA5Ljc0ODIyLDQuNjU1ODYgMTUuMTMxNTcsNC42NTU4NmM0Ljk0Njg2LDAgOS44OTM3MiwtMS4wMTg0NyAxMC40NzU3LC00LjM2NDg3YzAuNDM2NDksLTIuNjE4OTMgLTQuMzY0ODcsLTMuNDkxOSAtOS43NDgyMiwtNC4zNjQ4OGMtMTEuMjAzMTksLTEuODkxNDUgLTE2Ljg3NzUyLC00LjIxOTM4IC0xNS43MTM1NiwtMTIuNjU4MTRjMS43NDU5NSwtMTAuNjIxMiAxMi42NTgxNCwtMTMuNjc2NjEgMjEuNjc4ODksLTEzLjY3NjYxYzYuNDAxODIsMCAxMy4wOTQ2MywyLjE4MjQzIDE3LjYwNSw1LjIzNzg1bC02LjExMDgyLDcuNTY1NzhjLTMuNDkxOTEsLTIuMTgyNDMgLTguMDAyMjgsLTMuNzgyODkgLTEzLjA5NDY0LC0zLjc4Mjg5Yy01Ljk2NTMzLDAgLTkuNDU3MjMsMS43NDU5NSAtOS44OTM3MSw0LjUxMDM3Yy0wLjI5MSwxLjg5MTQ1IDEuMzA5NDYsMi42MTg5MyA4LjI5MzI2LDMuNzgyOWMxMC4xODQ3MSwxLjc0NTk1IDE4LjYyMzQ3LDMuMzQ2NCAxNy4wMjMwMiwxMy4wOTQ2M2MtMS4zMDk0Niw4Ljg3NTI0IC0xMC4zMzAyMSwxMy44MjIxIC0yMi4xMTUzNywxMy44MjIxYy02LjU0NzMyLC0wLjE0NTQ5IC0xNC45ODYwOCwtMi40NzM0MyAtMTkuNjQxOTUsLTYuMjU2MzJtLTM1NS4xNTU0NCwtNzguNzEzMjdsLTk4LjIwOTcyLDBjLTcuMjc0NzksMCAtMTMuMDk0NjMsNS44MTk4NCAtMTMuMDk0NjMsMTMuMDk0NjNsMCw5OC4yMDk3MmMwLDcuMjc0NzkgNS44MTk4NCwxMy4wOTQ2MyAxMy4wOTQ2MywxMy4wOTQ2M2w5OC4yMDk3MiwwYzcuMTI5MywwIDEzLjA5NDYzLC01LjgxOTg0IDEzLjA5NDYzLC0xMy4wOTQ2M2wwLC05OC4yMDk3MmMwLC03LjI3NDc5IC01LjgxOTg0LC0xMy4wOTQ2MyAtMTMuMDk0NjMsLTEzLjA5NDYzbS00OS4zMjMxMSw3NS44MDMzNWM0LjA3Mzg5LDAgOC40Mzg3NywtMS42MDA0NSAxMi42NTgxNSwtNS4zODMzNGw1LjgxOTgzLDYuNjkyODFjLTYuMTEwODMsNC45NDY4NiAtMTMuMDk0NjMsNy43MTEyOCAtMjAuMDc4NDMsNy43MTEyOGMtMTMuODIyMTEsMCAtMjIuNTUxODYsLTkuMTY2MjQgLTIwLjUxNDkyLC0yMi4xMTUzOGMyLjAzNjk0LC0xMi45NDkxMyAxMy44MjIxMSwtMjIuMTE1MzcgMjcuNjQ0MjIsLTIyLjExNTM3YzYuNjkyODEsMCAxMi45NDkxMywyLjYxODkzIDE3LjMxNDAxLDcuNDIwMjlsLTguMTQ3NzcsNi42OTI4MWMtMi4zMjc5NCwtMy4wNTU0MSAtNi4yNTYzMiwtNS4wOTIzNiAtMTAuNjIxMiwtNS4wOTIzNmMtOC4yOTMyNywwIC0xNC42OTUwOCw1LjM4MzM1IC0xNi4wMDQ1NSwxMy4wOTQ2M2MtMS4xNjM5Niw3LjcxMTI5IDMuNDkxOSwxMy4wOTQ2MyAxMS45MzA2NiwxMy4wOTQ2MyIgZmlsbD0iI2ZmZmZmZiIgZmlsbC1ydWxlPSJub256ZXJvIiBpZD0ic3ZnXzIiLz4KICA8L2c+CiA8L2c+Cgo8L3N2Zz4=">
  </head>
  <main class="<?=$component->identifiers()?>">
    <div class="header">
      <?php require_once "header/header.php"; ?>
    </div>
    <div class="content">
      <?=$content?>
    </div>
  </main>
<?php } ?>