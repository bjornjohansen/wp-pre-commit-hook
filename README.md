# wp-pre-commit-hook
Pre-commit hook for WordPress projects.

This package will install PHPCS with the WordPress Coding Standard definitions together with a git pre-commit hook script that will run PHP linting and the PHPCS whenever you do a commit to your project.

## Installation

`composer require bjornjohansen/wp-pre-commit-hook --dev`

Or manually add `"bjornjohansen/wp-pre-commit-hook": "*"` to the `require-dev` section in your `composer.json`

Then do a `composer update`
