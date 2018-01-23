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

## Table of Contents

* [Viewing the Sample](#viewingthesample)
* [Functionality](#functionality)
* [The Task](#task)
  - [Instructions](#instructions)
  - [Test Cases](#testcases)
- [Important Notes](#important)
  - [AngularJS](#angularjs)
  - [Laravel](#laravel)

<a name="viewingthesample"></a>
## Viewing the Sample

1. Run the installation steps shown above
2. Start a local server instance from the Exercise1 directory
`php artisan serve`
3. Open a browser window and go to your localhost, port 8000 (127.0.0.1:8000)
4. Select the "Sample" link.

<a name="functionality"></a>
## Functionality

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

<a name="task"></a>
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

<a name="instructions"></a>
### Instructions

To complete this task, the following must be done<sup>1</sup>:

* Create a `home` state with these attributes
  * url: `/angular`
  * templateUrl: `view/home-angular`
* Develop your controller in `order.controller.js`
* Update the HTML template in `home-angular.blade.php`

<a name="testcases"></a>
### Test Cases

* A list of four products appears (see below for specifics)
* Each product has an "Add" button
* An "Add All" button exists
* An Items In Cart section appears, empty by default
* When a user presses an "Add" button, that product appears in the cart with a removal "X"
* When a user presses an "Add" button, the "Add" button for that product is disabled
* When a user presses an "Add" button, the value for "Total" in the cart increases by the products's price
* When a user presses the "Add All" button, all four products appear in the cart
* When a user presses the "Add All" button, the "Add" buttons for all four products disable
* When any products appear in the cart, the total value of all products is shown
* When any products appear in the cart, a "Remove All" button exists
* When a user presses a removal button, that product is removed from the cart
* When a user presses a removal button, that product's "Add" button enables
* When a user presses a removal button, the total value shown decreases by the product's price
* When a user presses a removal button, if no products remain, the cart indicates that there is nothing to show
* When a user presses a removal button, if no products remain, the total goes to zero and is no longer shown
* When a user presses a removal button, if no products remain, the "Remove All" button disappears
* When a user presses the "Remove All" button, all products in the cart disappear
* When a user presses the "Remove All" button, all "Add" buttons enable
* When a user presses the "Remove All" button, the cart indicates that there is nothing to show
* When a user presses the "Remove All" button, the total goes to zero and is no longer shown
* When a user presses the "Remove All" button, the "Remove All" button disappears

**Original Products**

| Name      | Price |
| --------- | ----- |
| Product 1 | $25   |
| Product 2 | $15   |
| Product 3 | $20   |
| Product 4 | $10   |

<a name="important"></a>
## Important Notes

<a name="angularjs"></a>
### AngularJS

* The final product should match the sample, and all AngularJS code should use the [John Papa style guide](https://github.com/johnpapa/angular-styleguide/blob/master/a1/README.md).
* Any time a change is made to one of the AngularJS files, you will need to run `gulp` to view the change. This can be prevented by running `gulp watch` prior to starting.

<a name="laravel"></a>
### Laravel

Since this exercise does **not** require Laravel knowledge, the following should be kept in mind:

* Templates, while Blade PHP files, should be normal HTML (see `home-jquery.blade.php`)
* In order to not conflict with Laravel, start and end symbols have been changed. Use `<%` and `%>` instead of `{{` and `}}` (see [$interpolateProvider documentation](https://docs.angularjs.org/api/ng/provider/$interpolateProvider))

  For example, use `<% vm.variableName %>` instead of `{{ vm.variableName }}`

---
## Footnotes

[1] Please keep in mind that these are bare-bones instructions and do not include all steps.
