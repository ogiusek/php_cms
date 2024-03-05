![logo](https://www.svgrepo.com/show/353613/craftcms.svg)
# PHP CMS

PHP CMS is a lightweight, easy-to-use content management system built with PHP. It is designed for small to medium-sized websites and allows users to easily manage and update their website content without any technical knowledge.

## First run
- git clone last stable version
- Rename `env.php.copy` to `env.php` and fill your database credentials
- To add first user follow instructions in `/index.php`
- Now you can run project with `php -S localhost:3000` linux command
- To enter admin open in browser `localhost:3000/admin`
- If admin panel is not showing or styles are messed up check your php version (8.2 is minimum)
- I hope you will be able to act on your own from now on
- (: good luck

## Components
### how add component step by step
create directory `/include/components/$component_name`\
create 4 files inside `class.php`, `render.php`, `admin/render.php`, `admin/handler.php`

`class.php`
```php
<?php
class $component_name{
   public string $example_variable = "default value";
};
```

`renderer.php`
```php
<?php
$content = \components()->get_content();
?>
<h2><?=$content->example_variable?></h2>
```

`admin/renderer.php`
```php
<?php
$content = \components()->get_content();
?>
<div class="input">
   <label for="input_name">example_variable value</label>
   <input type="text" name="input_name" value="<?=$content->example_variable?>">
</div>
```

`admin/handler.php`
```php
<?php
$component = new $component_name();
$component->example_variable = $_POST['input_name'];
echo serialize($component);
```

To show component in admin go to `/admin/frontend/components`\
And fill the form with `$component_name`\
remember to replace `$component_name` with your component name (:

Now to check is your component working you can try adding one in `/admin/frontend/pages`\
Choose your page (i'll take '/'). Click button `content`. Add your element.\
Now you can go to page ('/') to which you've added content.\
Your element should show up. 

## Features
- Simple and intuitive user interface
- Content editing and publishing
- Image and file management
- User management and permissions
- Responsive design
- SEO-friendly URLs

## Support
For any issues or feedback, please submit an issue on the GitHub repository or contact us on github

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.