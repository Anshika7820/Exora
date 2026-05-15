# Exora | Next-Gen Virtual Exhibition Platform 🏛️

Exora is a high-end, immersive Virtual Exhibition Platform built with **Laravel**, **MongoDB**, and **Tailwind CSS**. It redefines digital engagement by providing a professional environment for hosting and participating in virtual events.

## 🚀 Key Features

### 👤 Role-Based Ecosystem
- **Hoster:** Orchestrate exhibitions, manage virtual stalls (booths), and lead live auditorium sessions from a centralized **Command Center**.
- **Participater:** Explore immersive 3D galleries, interact with brands, and attend live keynotes with real-time engagement.

### 🏛️ 7 Immersive Exhibition Halls
- **Diverse Environments:** Includes Atrium A, Tech-Expanse B, Robotics Hub, Diamond Vault, Global Book Fair, Masterpiece Art Gallery, and Automobile Showcase.
- **Immersive 3D Engine:** High-fidelity 3D environments powered by **A-Frame and WebGL**, allowing for deep exploration and real-time object placement.
- **Live Sync:** 3D Placed objects automatically sync with the 2D Gallery UI using MongoDB real-time querying.

### 🎪 Marketplace & Trade Booths
- Professional **Stall Orchestration** for Hosters to showcase brands.
- Interactive engagement tools for Participaters to request meetings and view digital galleries.

### 🎤 Live Auditorium
- Real-time **Stage Orchestration** with live video feeds and integrated community chat.
- Status indicators for live sessions to ensure maximum audience reach.

### 🤖 Exora Guide
- A humanized digital companion to assist Participaters throughout their journey, ensuring a seamless and non-robotic user experience.

## 🛠️ Technology Stack
- **Backend:** Laravel 12.x
- **Database:** MongoDB (NoSQL)
- **Frontend:** Blade, Tailwind CSS (Glassmorphism), Vite
- **3D Rendering:** A-Frame & WebGL
- **Media:** Unsplash API for high-resolution exhibition assets

## 📦 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Anshika7820/Exora.git
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   - Copy `.env.example` to `.env`.
   - Configure your MongoDB connection.
   - Set your Unsplash API key for dynamic image loading.

4. **Run the Platform:**
   ```bash
   php artisan serve
   npm run dev
   ```

## 💎 Design Philosophy
Exora follows a **Premium Dark Aesthetic** with **Plus Jakarta Sans** typography, high-contrast cyan/purple gradients, and glassmorphic UI elements to provide a state-of-the-art exhibition experience.

---
Built with ❤️ by [Anshika](https://github.com/Anshika7820)
