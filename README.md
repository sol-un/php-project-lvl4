[![Maintainability](https://api.codeclimate.com/v1/badges/023af4cbe1c5d6eb8380/maintainability)](https://codeclimate.com/github/sol-un/php-project-lvl4/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/023af4cbe1c5d6eb8380/test_coverage)](https://codeclimate.com/github/sol-un/php-project-lvl4/test_coverage)
[![PHP CI Status](https://github.com/sol-un/php-project-lvl4/actions/workflows/workflow.yml/badge.svg)](https://github.com/sol-un/php-project-lvl4/actions/workflows/workflow.yml)
[![Actions Status](https://github.com/sol-un/php-project-lvl4/workflows/hexlet-check/badge.svg)](https://github.com/sol-un/php-project-lvl4/actions)

# Task Manager

This is a simple task manager app written in PHP as a pet project under the guidance of Hexlet, a self-education platform. [Learn more about Hexlet (in Russian)](https://ru.hexlet.io/pages/about?utm_source=github&utm_medium=link).

The app is available at https://warm-lowlands-90893.herokuapp.com/
## Requirements

- PHP ^8.0
- Composer
- PostgreSQL 14.0

## Installation & Usage

```
git clone https://github.com/sol-un/php-project-lvl4.git
cd php-project-lvl4
make setup
make migrate-refresh // create and seed database
make start // launch app at http://localhost:8000/