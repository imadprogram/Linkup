# 🚀 LinkUp

**LinkUp** is a modern, dynamic social networking platform built with **Laravel**. It allows users to connect, send friend requests, and manage their social circle with a sleek and responsive interface.

---

## 🌟 Key Features

*   **🔐 Authentication System**: Secure Register & Login with auto-generated unique usernames.
*   **🔍 User Discovery**: Search for users instantly by name or username (case-insensitive).
*   **🤝 Friendship System**:
    *   Send Friend Requests.
    *   View Pending Requests with "Time Ago" format.
    *   Accept, Reject, or Delete Requests.
    *   Unfriend users.
*   **👤 Profile Management**: Upload profile pictures, update bio, and details.
*   **📱 Responsive UI**: Beautiful design optimized for all devices.

---

## 📊 System Architecture & Diagrams

Here are the visual representations of the system structure.

| **Diagram Type** | **Link** |
| :--- | :--- |
| **🗄️ ERD (Database)** | [View ERD Diagram](https://lucid.app/lucidchart/131e41e5-4e17-405c-b57e-25d72af10f8b/edit?viewport_loc=-900%2C-365%2C1814%2C734%2C0_0&invitationId=inv_1cf07676-11e9-4176-981f-5d66295d6c84) *<- Paste link here* |
| **🧩 Class Diagram** | [View Class Diagram](https://lucid.app/lucidchart/b601fd6f-3b59-4c52-a5d8-74bdb45cbe20/edit?viewport_loc=-1068%2C-728%2C1954%2C948%2C0_0&invitationId=inv_acc94c7c-d1ce-45b8-9f1f-942091c1b179) *<- Paste link here* |
| **👤 Use Case Diagram** | [View Use Case Diagram](https://lucid.app/lucidchart/50887b18-ae63-4a81-9bf6-9c56a21a3966/edit?viewport_loc=-901%2C-364%2C2221%2C1077%2C0_0&invitationId=inv_55ff33bf-6d01-4bb2-bb1e-81479300f995) *<- Paste link here* |

---

## 🛠️ Tech Stack

*   **Framework:** Laravel 10/11
*   **Database:** PostgreSQL / MySQL
*   **Frontend:** Blade Templates + TailwindCSS
*   **Icons:** FontAwesome

---

## ⚡ Getting Started

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/linkup.git
    cd linkup
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Configure Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

5.  **Serve**
    ```bash
    php artisan serve
    ```

---

Made with ❤️ by You.
