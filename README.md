# Zamboanga City Hall Ticketing System
![ticketing](https://github.com/PexWave/e-ticketMo/assets/139829241/cb236ba6-c789-4763-adbf-e52a78a6b511)

This ticketing system application is built with Laravel, Vue.js, Vuetify, and MySQL. It utilizes Pusher for real-time updates and WebSockets. The app is designed to assist the Computer Division Office at Zamboanga City Hall in managing and resolving issues from various offices within the City Hall.

## Key Features

- **Ticket Creation**: Users can create tickets specifying the issue category (hardware or software) and difficulty level (1-5).
- **Automated Assignment**: An algorithm assigns tickets to available Computer Division Staff based on their skills, category match, and availability.
- **Skill Matching**: Ensures that the assigned staff has a skill level equal to or greater than the ticket difficulty level.
- **Extension Requests**: Staff can request an extension if the task cannot be completed on time.

## Technologies Used

- **Frontend**: Vue.js and Vuetify
- **Backend**: Laravel
- **Database**: MySQL
- **Real-Time Updates**: Pusher and WebSockets

## How It Works

1. **Ticket Creation**:
   - A user creates a ticket, specifying the issue category (hardware or software) and difficulty level (1-5).

2. **Ticket Assignment**:
   - The system automatically assigns the ticket to an available staff member from the Computer Division.
   - Assignment is based on staff availability, skill level, and category match.

3. **Task Management**:
   - Staff members receive notifications for new tickets via real-time updates.
   - Staff can request extensions if they cannot complete the task on time.

## Getting Started

### Prerequisites

- PHP 8.2
- Composer
- Node.js and npm
- MySQL

### Installation

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/PexWave/e-ticketMo.git
    cd zamboanga-ticketing-system
    ```

2. **Backend Setup**:
    - Install PHP dependencies:
      ```bash
      composer install
      ```
    - Create a `.env` file and configure your database and Pusher credentials:
      ```env
      DB_DATABASE=your_database
      DB_USERNAME=your_username
      DB_PASSWORD=your_password
      PUSHER_APP_ID=your_pusher_app_id
      PUSHER_APP_KEY=your_pusher_app_key
      PUSHER_APP_SECRET=your_pusher_app_secret
      PUSHER_APP_CLUSTER=your_pusher_app_cluster
      ```

    - Run database migrations:
      ```bash
      php artisan migrate
      ```

3. **Frontend Setup**:
    - Install JavaScript dependencies:
      ```bash
      npm install
      ```
    - Compile the frontend assets:
      ```bash
      npm run dev
      ```

4. **Run the Application**:
    ```bash
    php artisan serve
    ```

## Usage

- **Create Tickets**: Users can log in and create tickets specifying issue details.
- **Manage Tickets**: Staff members can view and manage assigned tickets, request extensions, and update ticket statuses.
- **Real-Time Notifications**: Receive real-time updates on ticket assignments and status changes.
