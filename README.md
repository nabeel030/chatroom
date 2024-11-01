# Chatroom API

Welcome to the Chatroom API! This API allows users to create, join, and leave chatrooms, send messages (including attachments), and retrieve messages from chatrooms in real-time. It utilizes Laravel with Sanctum for authentication, Pusher for real-time features, and WebSocket for efficient communication.

## Table of Contents

- [Technologies](#technologies)
- [Installation](#installation)
- [API Documentation](#api-documentation)
- [Endpoints](#endpoints)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Technologies

This application is built using the following technologies:

- PHP: ^8.2
- Laravel Framework: ^11.3
- Laravel Octane: ^2.5
- Laravel Sanctum: ^4.0
- Pusher PHP Server: ^7.2
- Pusher JS: ^8.4.0-rc2
- Laravel echo: ^1.16.1
- Swoole: 5.15

## Installation

To set up the Chatroom API locally, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://your-repository-url.git
   cd chatroom

2. **Install Dependencies:**
   ```bash
   composer install

3. **Set up environment variables:**
    - Rename the .env.example file to .env and update the database and other configuration settings as needed.

4. **Generate the application key:**
   ```bash
   php artisan key:generate

5. **Run Migrations:**
   ```bash
   php artisan migrate

5. **Start the server:**
   ```bash
   php artisan serve

