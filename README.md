![logo](https://www.svgrepo.com/show/353613/craftcms.svg)
# PHP CMS

PHP CMS is a lightweight, programmers friendly, easy-to-use content management system built with PHP. It is designed for small to medium-sized websites and allows users to easily manage and update their website content without any technical knowledge.

## First run
### with docker(reccomended)
- `git pull https://github.com/ogiusek/php_cms`
- run `PORT=3000 docker compose -f docker/dev/docker-compose.yml up` or `PORT=3000 docker compose -f docker/deploy/docker-compose.yml up`
- enter `localhost:3000` wait till database loads refresh 2 times and login: `root@gmail.com` password: `root` 
- when you login go to `localhost:3000/admin/frontend/components` click autoload
- now you can add pages and use components in `localhost:3000/admin/frontend/pages`
- now you can create pages and edit their content

### without docker
- required php version (8.2 is minimum)
- `git pull https://github.com/ogiusek/php_cms`
- Rename `env.php.copy` to `env.php` and fill your database credentials
- Now you can run project with `php -S localhost:3000` linux command
- To enter admin open in browser `localhost:3000` refresh once
- when you login go to `localhost:3000/admin/frontend/components` click autoload
- now you can add pages and use components in `localhost:3000/admin/frontend/pages`
- now you can create pages and edit their content

### how site looks ?
example run and creating first page with docker
[![video preview](./readme/logo.svg)](./readme/cms-first-run.webm)

## Components
### how add component step by step
create directory `/include/components/$component_name`\
create 4 files inside `class.php`, `render.php`, `admin/render.php`, `admin/handler.php`, `config.json`

`class.php`
```php
<?php
namespace components;
// if you use other component type here:
// \components()->load_class("image"); // where instead of image you type required class
class $component_name{
   public string $example_variable = "default value";
};
```

`render.php`
```php
<?php
$content = \components()->get_content();
$component = \component(__DIR__) // <- optional
  ->css_file("file.css") // <- optional
  ->js_file("file.js"); // <- optional
?>
<h2 class="<?=$component->identifiers()?>"><?=$content->example_variable?></h2>
```

`admin/render.php`
```php
<?php
$content = \components()->get_content();
$component = \component(__DIR__) // <- optional
  ->css_file("file.css") // <- optional
  ->js_file("file.js"); // <- optional
?>
<div class="input <?=$component->identifiers()">
   <label for="input_name">example_variable value</label>
   <input type="text" data-name="input_name" aria-label="input_name" value="<?=$content->example_variable?>">
</div>
```

`admin/handler.php`
```php
<?php
$content = \components()->get_content();
$component = \components()->get_instance("$component_name");
$component->example_variable = $content['input_name'];
return $component;
```

`config.json`(optional)
```json
{
  "autoload": true
}
```

To show component in admin go to `/admin/frontend/components` and press auto_load

Now to check is your component working you can try adding one in `/admin/frontend/pages`\
Choose your page (i'll take '/'). Click button `content`. Add your element.\
Now you can go to page ('/') to which you've added content.\
Your element should show up. 

### extra

#### components api requests
if you need to request server after rendering component you can use `/controller`\
How create example api and use ?

`/controllers/example_route/controller.php`
```php
<?php
\request\verify()
   ->required_params(["a", "b"]);

$a = $_POST['a'];
$b = $_POST['b'];
if(is_numeric($a) && is_numeric($b)){
   echo (((float)$a) + ((float)$b));
}else{
   echo "a or b is not number";
}
```

`/script.js` (remember to include script in `render.php` with `\component(__DIR__)->js_file("script.js")`)
```js
fetch_controller("component_name", "example_route", {
   a: 1,
   b: 2
}).then(notify);
```

## Features
- Simple and intuitive user interface
- Content editing and publishing
- Image and file management
- Responsive design
- SEO-friendly URLs

## Tools
### Url variables
To create variable url you can type `$` like this `/page/$id/edit` \
optionaly you can use `/page/.*` to redirect all request starting with page to one component

## Support
For any issues or feedback, please submit an issue on the GitHub repository or contact us on github

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
