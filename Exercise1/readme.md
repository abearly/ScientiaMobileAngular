# Exercise 1: Basic Order Form

The goal of this exercise is to create a basic order form using AngularJS. Prior to starting, please review the example form that has been created using jQuery.

## Setup

Perform the following setup steps:

1. Install composer dependencies
`composer update`
2. Install node modules
`npm install`
3. Compile assets
`gulp`

## Viewing the Sample

1. Run the installation steps shown above
2. Start a local server instance from the Exercise1 directory
`php artisan serve`
3. Open a browser window and go to your localhost, port 8000 (127.0.0.1:8000)
4. Select the "Sample" link.

### Functionality

Your final product should match the provided sample, so be sure to play around with it prior to starting. The following functionality exists.

* A list of available products, each including
  * Name
  * Price
  * Add button that disables after the product is added
* An "Add All" button
* A list of all items in the cart
  * If no items exist, a "Nothing to show" message
* For each item in the cart
  * Name
  * Remove link
* If items are in the cart
  * The total price of all items in the cart
  * A "Remove All" button

## The Task

Your task is to replicate the sample using AngularJS (version 1.5.8). The back-end route for this is already in place at `/angular`. All files needed have also been provided, so you will need to edit them to complete the task.

All AngularJS files live at `public/js/app` and all template files are at `resources/views`.

The following files will be needed and are the only ones that should be changed:

* AngularJS Files
  * An angular module, `app`, in `main.js`
  * A skeleton states file, `app.state.js`
  * An empty controller file, `order.controller.js`
* Template File
  * A skeleton template, `home-angular.blade.php`

All necessary dependencies, including UI-Router, have already been imported into the HTML, and the module has already been initialized (see `resources/views/layouts/application_master.blade.php` and `resources/views/content.blade.php`).

Bootstrap 3 CSS is also included.

### Instructions

To complete this task, the following must be done<sup>1</sup>:

* Create a `home` state with these attributes
  * url: `/angular`
  * templateUrl: `view/home-angular`
* Develop your controller in `order.controller.js`
* Update the HTML template in `home-angular.blade.php`

[1] Please keep in mind that these are bare-bones instructions and do not include all steps.

#### Laravel Notes

Since this exercise does **not** require Laravel knowledge, the following should be kept in mind:

* Templates, while Blade PHP files, should be normal HTML (see `home-jquery.blade.php`)
* In order to not conflict with Laravel, start and end symbols have been changed. Use `<%` and `%>` instead of `{{` and `}}` (see [$interpolateProvider documentation](https://docs.angularjs.org/api/ng/provider/$interpolateProvider))

  For example, use `<% vm.variableName %>` instead of `{{ vm.variableName }}`

##### AngularJS Notes
* The final product should match the sample, and all AngularJS code should use the [John Papa style guide](https://github.com/johnpapa/angular-styleguide/blob/master/a1/README.md).
* Any time a change is made to one of the AngularJS files, you will need to run `gulp` to view the change. This can be prevented by running `gulp watch` prior to starting.
