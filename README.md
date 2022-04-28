# ASHR STARTER PACKAGE

**ASHR STARTER PACKAGE** is package contains function that is frequently used on laravel project.

## Instalation

You can install the package via composer

```bash
composer require ashr/starter
```
> Packagist: [https://packagist.org/packages/ashr/starter](https://packagist.org/packages/ashr/starter)

* Add ```\Ashr\Starter\ServiceProvider::class``` to config/app.php
* Publish config if needed ```php artisan vendor:publish --tag=ashr-starter```

## How to use

* Use middleware: ```Route::post('/', [PostController::class, 'createPost'])->middleware('can-access:create-post');``` create-post is permission need authorize to auth service
* Customize error form request by extending class ```Ashr\Starter\Services\Response\CustomFormRequest```
* For formatting basic crud response use methods:
  * responseCreated
  * responseCreateFailed
  * responseNotFound
  * responseUpdated
  * responseUpdatedFailed
  * responseDeleted
  * responseDeleteFailed