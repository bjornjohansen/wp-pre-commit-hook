# wp-pre-commit-hook
Pre-commit hook for WordPress projects.

This package will install PHPCS with the WordPress Coding Standard definitions together with a git pre-commit hook script that will run PHP linting and the PHPCS whenever you do a commit to your project.

If your project has a phpcs.ruleset.xml file available, the pre-commit hook will use it as a ruleset definition. Otherwise the “WordPress” ruleset will be used.

## Installation

`composer require bjornjohansen/wp-pre-commit-hook --dev`

Or manually add `"bjornjohansen/wp-pre-commit-hook": "*"` to the `require-dev` section in your `composer.json`

Then do a `composer update`
