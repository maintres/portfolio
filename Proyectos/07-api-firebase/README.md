# E-Commerce React con Firebase 🛍️

Este proyecto es una aplicación de comercio electrónico desarrollada con React y Firebase, que permite a los usuarios navegar por productos, agregarlos al carrito y realizar compras.

## 🚀 Características

- Navegación entre categorías de productos
- Carrito de compras interactivo
- Detalles de productos
- Proceso de checkout
- Gestión de estado con Context API
- Base de datos en tiempo real con Firebase
- Diseño responsive
- Formularios validados con React Hook Form

## 🛠️ Tecnologías Utilizadas

- **React** v19.1.1 - Biblioteca principal para la construcción de la interfaz
- **React Router DOM** v7.9.1 - Navegación y enrutamiento
- **Firebase** v12.3.0 - Backend y base de datos
- **React Hook Form** v7.63.0 - Manejo y validación de formularios
- **Vite** v7.1.2 - Herramienta de construcción y desarrollo
- **ESLint** v9.33.0 - Linting y buenas prácticas de código

## 📁 Estructura del Proyecto

```
src/
├── components/
│   ├── BarraCarrito/     # Componentes del widget del carrito
│   ├── Carrito/          # Componente principal del carrito
│   ├── Context/          # Context API para el estado global
│   ├── Logo/             # Componente del logo
│   ├── Navbar/           # Barra de navegación
│   └── Tienda/           # Componentes principales de la tienda
├── firebase/             # Configuración de Firebase
├── helpers/              # Funciones auxiliares
└── stylesheets/         # Estilos CSS
```

## 🚀 Instalación

1. Clona el repositorio:
```bash
git clone [URL-del-repositorio]
```

2. Instala las dependencias:
```bash
npm install
```

3. Crea un archivo `.env` con tus credenciales de Firebase (ver `.env.example`)

4. Inicia el servidor de desarrollo:
```bash
npm run dev
```

## 📦 Scripts Disponibles

- `npm run dev` - Inicia el servidor de desarrollo
- `npm run build` - Construye la aplicación para producción
- `npm run lint` - Ejecuta el linter
- `npm run preview` - Previsualiza la versión de producción

## 🔒 Variables de Entorno

Para ejecutar este proyecto, necesitarás agregar las siguientes variables de entorno a tu archivo `.env`:

```env
VITE_FIREBASE_API_KEY=tu_api_key
VITE_FIREBASE_AUTH_DOMAIN=tu_auth_domain
VITE_FIREBASE_PROJECT_ID=tu_project_id
VITE_FIREBASE_STORAGE_BUCKET=tu_storage_bucket
VITE_FIREBASE_MESSAGING_SENDER_ID=tu_messaging_sender_id
VITE_FIREBASE_APP_ID=tu_app_id
VITE_FIREBASE_MEASUREMENT_ID=tu_measurement_id
```

## 🤝 Contribuir

Las contribuciones son siempre bienvenidas. Por favor, lee las guías de contribución antes de enviar un pull request.

## 📝 Licencia

Este proyecto está bajo la Licencia MIT - mira el archivo [LICENSE.md](LICENSE.md) para más detalles.