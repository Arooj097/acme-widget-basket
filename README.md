# Acme Widget Basket

This project is a proof of concept for Acme Widget Co's new sales system.

## Installation

To install the project, clone the repository and install the dependencies using Composer:

```bash
git clone https://github.com/Arooj097/acme-widget-basket.git
cd acme-widget-basket
composer install

## Usage

To run tests, use:

```bash
vendor/bin/phpunit tests/BasketTest.php

Code Explanation:

Basket.php:

Product Catalogue: The Basket class is initialized with a product catalogue, delivery rules, and special offers. The product catalogue includes product codes, names, and prices.

Adding Items: The add method allows products to be added to the basket by their code. If an invalid product code is provided, an exception is thrown.

Calculating Total: The total method computes the total cost of the basket. It takes into account:

Product Prices: Aggregates the cost of products based on their quantity.

Special Offers: Applies discounts based on predefined offers (e.g., "buy one red widget, get the second half price").

Delivery Costs: Uses a separate method to calculate the delivery cost based on the total amount spent.

BasketTest.php:

Unit Tests: Uses PHPUnit to test the Basket class. The tests cover:

    Standard Cases: Validates that the total cost calculations are correct for different basket contents.
    Edge Cases: Includes tests for an empty basket, invalid product codes, and special offer scenarios.

Enhancements:

While the initial assignment required basic functionality, several enhancements were made to improve the code's robustness and flexibility:

    Error Handling: Added error handling for invalid product codes to prevent issues during execution and provide meaningful feedback to users.

    Code Flexibility: Modified the implementation to be more adaptable for future extensions:

    Separate Delivery Cost Calculation: Moved delivery cost logic to a dedicated method to make the total method cleaner and more maintainable.
    Flexible Offer Handling: Enhanced the offer application logic to be more general, allowing for easier future extensions and additional offer types.
    Expanded Test Coverage: Added test cases for edge scenarios and invalid inputs to ensure the code behaves correctly in a variety of situations and to catch potential issues early.

    Documentation: Improved the README to clearly describe the functionality of the Basket class, assumptions made during implementation, and detailed instructions for installation and usage.

By incorporating these enhancements, the project is better prepared for future requirements and provides a more robust and user-friendly solution.