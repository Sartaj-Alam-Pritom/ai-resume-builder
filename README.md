<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# AI Resume Builder

AI Resume Builder is a web application designed to help users optimize their resumes, generate personalized cover letters, and practice mock interviews using AI-powered tools. This project leverages Laravel, Tailwind CSS, and OpenAI APIs to provide an intuitive and interactive user experience.

## Features

- **Smart Resume Builder**: Automatically optimize your resume for the Bangladeshi job market.
- **Cover Letter Generator**: Generate personalized cover letters tailored to any job description.
- **Interview Simulation**: Practice mock interviews with real-time feedback on performance.
- **Analytics Dashboard**: View insights on common resume errors and interview trends.

## Screenshots

### Welcome Page
![Welcome Page](images/welcome.png)

### Dashboard
![Dashboard](images/dashboard.png)

### Resume Builder
![Resume Builder](images/resume-builder.png)

### Cover Letter Generator
![Cover Letter Generator](images/cover-letter-generator.png)

### Interview Simulation
![Interview Simulation](images/interview-simulation.png)

### Analytics Dashboard
![Analytics Dashboard](images/analytics-dashboard.png)

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js and npm
- MySQL or another supported database
- OpenAI API Key (optional for AI features)

### Steps to Run Locally

1. Clone the repository:
   ```bash
   git clone https://github.com/Sartaj-Alam-Pritom/ai-resume-builder.git
   cd ai-resume-builder

   composer install
   npm install
   cp .env.example .env

##Update the .env file with your database credentials and OpenAI API key:
 ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   OPENAI_API_KEY=your_openai_api_key

##MIT License

Copyright (c) 2023 Sartaj Alam Pritom

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
