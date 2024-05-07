# Lab Pemesinan

[Lab Pemesinan](https://github.com/hsdhts/lab-pemesinan.git) is The "Web-Based Machining Lab Database" streamlines lab operations, managing equipment, maintenance, experiments, and projects for enhanced collaboration and decision-making.

## Features ( Coming Soon )

-   Build chat feature

## Preview Website

Preview Dashboard

![Lab Pemesinan](/public/assets/preview/dashboard.png)

Preview Maintenance

![Lab Pemesinan](/public/assets/preview/maintenance.png)

Preview Working Report | Superadmin & Admin

![Lab Pemesinan](/public/assets/preview/working_report.png)

Preview Show User Profile | Admin & Mahasiswa

![Luminary](/public/assets/preview/show-users.png)

Preview Profile

![Luminary](/public/assets/preview/profile.png)


## Installation

-   Install [Composer](https://getcomposer.org/download) and [Npm](https://nodejs.org/en/download)
-   Clone the repository: `git clone https://github.com/hsdhts/lab-pemesinan.git "project"`
-   Go to the project directory: `cd project`
-   Install dependencies: `composer install`
-   Run `cp .env.example .env` for create .env file
-   Run `php artisan key:generate` for generate key
-   Run `php artisan migrate --seed` for migration database
-   Run `php artisan storage:link` for create folder storage
-   Run `php artisan serve` for run the project

## Authors

Lab Pemesinan is created by [Husada](https://github.com/hsdhts).
