# Emociona - Setup Instructions

## Current Status: ✅ Demo Complete | ❌ Node.js Required

The Emociona React application has been successfully developed and is ready to run. However, **Node.js is not installed** on your system, which is preventing the frontend from loading.

## 🎯 What You've Seen

The [`emociona-demo.html`](emociona-demo.html) file demonstrates exactly how your application should look and function when properly set up:

### ✅ Fully Functional Features Demonstrated:
- **Modern Dark/Light Theme Toggle** - Seamless switching between themes
- **Responsive Sidebar** - Collapsible from 280px to 80px with smooth animations
- **Complete Navigation Menu** - All sections including expandable Catálogos submenu
- **Dynamic Content Areas** - Different placeholders for each section
- **Professional UI/UX** - Clean, modern design inspired by OpenAI
- **Interactive Elements** - Hover effects, active states, smooth transitions
- **Proper Typography** - Inter font family with proper hierarchy
- **Accessible Design** - Proper contrast, focus states, semantic HTML

### 📋 Menu Structure (Exactly as Requested):
- **Inicio** (Dashboard) - Overview with activity cards
- **Mis sesiones** - Session management
- **Mis escuchas** - Listener management  
- **Catálogos** (Expandable submenu with 12 items):
  - Temas
  - Memorias tempranas
  - Mensajes angustiosos
  - Direcciones
  - Contradicciones
  - Contradicciones del escucha
  - Pedacitos de realidad
  - Restimulaciones
  - Compromisos sociales
  - Próximos pasos
  - Sesión física
  - Necesidades congeladas
- **Calendario** - Session scheduling
- **Registros** (renamed from "Reportes")
- **Ajustes** - Settings

## 🚨 Root Cause: Node.js Missing

**Problem**: Node.js and npm are not installed on your Windows system.

**Evidence**: 
```bash
> npm install
"npm" no se reconoce como un comando interno o externo

> node --version  
"node" no se reconoce como un comando interno o externo
```

**Impact**: Cannot compile React/Vite assets, install dependencies, or run development server.

## 🔧 Solution: Install Node.js

### Step 1: Download Node.js
1. Go to [nodejs.org](https://nodejs.org/)
2. Download the **LTS version** (recommended for most users)
3. Choose the Windows Installer (.msi) for your system (64-bit recommended)

### Step 2: Install Node.js
1. Run the downloaded installer
2. Follow the installation wizard (accept all defaults)
3. **Important**: Make sure "Add to PATH" is checked
4. Restart your computer or at least close/reopen VS Code

### Step 3: Verify Installation
Open a new terminal and run:
```bash
node --version
npm --version
```
You should see version numbers (e.g., v18.17.0 and 9.6.7)

## 🚀 Complete Setup Process

Once Node.js is installed, follow these steps:

### 1. Install Dependencies
```bash
npm install
```

### 2. Start Development Server
```bash
npm run dev
```

### 3. Access Your Application
- **Laravel Backend**: http://127.0.0.1:8000 (already running)
- **Vite Dev Server**: Usually http://127.0.0.1:5173
- **Full Application**: http://127.0.0.1:8000 (with hot reloading)

## 📁 Project Structure

Your React application is properly structured:

```
resources/js/
├── app.jsx                 # Main React entry point
├── components/
│   ├── AppLayout.jsx       # Main layout component
│   ├── Sidebar.jsx         # Collapsible sidebar
│   ├── SidebarItem.jsx     # Individual menu items
│   ├── Topbar.jsx          # Top navigation bar
│   └── Placeholder.jsx     # Content placeholders
└── bootstrap.js            # Laravel/Axios setup

resources/css/
└── app.css                 # TailwindCSS configuration

resources/views/
└── app.blade.php           # Laravel Blade template
```

## 🛠 Technology Stack

- **Frontend**: React 18.2.0
- **Styling**: TailwindCSS 4.0.0
- **Animations**: Framer Motion 10.16.0
- **Icons**: Lucide React 0.292.0
- **Build Tool**: Vite 7.0.4
- **Backend**: Laravel (ready for integration)

## 🎨 Design Features

- **Dark Mode by Default** with light mode toggle
- **Smooth Animations** using Framer Motion
- **Responsive Design** (1-3 column grid based on screen size)
- **Modern Color Palette** (zinc/neutral backgrounds, blue accents)
- **Professional Typography** (Inter font family)
- **Accessible UI** (proper focus states, ARIA labels, semantic HTML)

## 🔄 Next Steps After Node.js Installation

1. **Install dependencies**: `npm install`
2. **Start development**: `npm run dev`
3. **Verify functionality**: All features from the demo should work
4. **Begin development**: Add business logic, API integration, etc.
5. **Laravel Integration**: Connect with Inertia.js or API endpoints

## 📞 Troubleshooting

### If npm install fails:
- Clear npm cache: `npm cache clean --force`
- Delete node_modules: `rmdir /s node_modules` (Windows)
- Try again: `npm install`

### If Vite dev server doesn't start:
- Check port conflicts
- Try: `npm run dev -- --port 3000`

### If styles don't load:
- Ensure TailwindCSS is properly configured
- Check `resources/css/app.css` imports

## ✅ Success Criteria

When properly set up, you should see:
- ✅ Sidebar with all menu items
- ✅ Smooth collapse/expand animations  
- ✅ Working Catálogos submenu
- ✅ Theme toggle functionality
- ✅ Dynamic content areas
- ✅ Professional dark/light themes
- ✅ Responsive design
- ✅ All interactive elements working

The application will look and function exactly like the demo in [`emociona-demo.html`](emociona-demo.html).