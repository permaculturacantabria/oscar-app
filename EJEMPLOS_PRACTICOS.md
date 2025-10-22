# 🎯 Ejemplos Prácticos para Empezar - Emociona

## 🚀 Ejercicios Paso a Paso (Principiantes)

### Ejercicio 1: Tu Primer Cambio Simple
**Objetivo**: Cambiar el texto de bienvenida

1. **Abre el archivo**: [`resources/js/components/Placeholder.jsx`](resources/js/components/Placeholder.jsx)
2. **Busca la línea** que dice "Bienvenido a Emociona"
3. **Cámbiala por**: "¡Hola! Bienvenido a mi aplicación"
4. **Guarda el archivo** (Ctrl + S)
5. **Ve el cambio** en http://localhost:8000

### Ejercicio 2: Cambiar Colores del Sidebar
**Objetivo**: Personalizar la apariencia

1. **Abre**: [`resources/js/components/Sidebar.jsx`](resources/js/components/Sidebar.jsx)
2. **Busca la línea ~67**: `bg-gray-900 dark:bg-gray-950`
3. **Cámbiala por**: `bg-purple-900 dark:bg-purple-950`
4. **Guarda y ve el resultado**

### Ejercicio 3: Añadir un Nuevo Elemento al Menú
**Objetivo**: Expandir la navegación

1. **Abre**: [`resources/js/components/Sidebar.jsx`](resources/js/components/Sidebar.jsx)
2. **Busca el array `menuItems`** (línea ~23)
3. **Añade después de 'dashboard'**:
```jsx
{ id: 'mi-seccion', label: 'Mi Nueva Sección', icon: Star },
```
4. **Importa el icono** al inicio del archivo:
```jsx
import { Star } from 'lucide-react';
```

## 🛠️ Creando Tu Primer Componente

### Paso 1: Crear el Archivo
Crea: `resources/js/components/MiPrimerComponente.jsx`

```jsx
import React from 'react';

const MiPrimerComponente = () => {
  return (
    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md">
      <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        ¡Mi Primer Componente!
      </h2>
      <p className="text-gray-600 dark:text-gray-300">
        Este es mi primer componente React personalizado.
      </p>
      <button className="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
        ¡Haz clic aquí!
      </button>
    </div>
  );
};

export default MiPrimerComponente;
```

### Paso 2: Usar el Componente
1. **Abre**: [`resources/js/components/Placeholder.jsx`](resources/js/components/Placeholder.jsx)
2. **Importa tu componente**:
```jsx
import MiPrimerComponente from './MiPrimerComponente';
```
3. **Úsalo en el JSX**:
```jsx
<div className="space-y-6">
  <MiPrimerComponente />
  {/* resto del contenido */}
</div>
```

## 🎨 Ejercicios con TailwindCSS

### Ejercicio 4: Crear una Tarjeta de Información
Crea: `resources/js/components/TarjetaInfo.jsx`

```jsx
import React from 'react';
import { Calendar, User, Clock } from 'lucide-react';

const TarjetaInfo = ({ titulo, descripcion, fecha, usuario }) => {
  return (
    <div className="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 hover:shadow-lg transition-shadow">
      <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
        {titulo}
      </h3>
      <p className="text-gray-600 dark:text-gray-300 mb-4">
        {descripcion}
      </p>
      
      <div className="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
        <div className="flex items-center space-x-1">
          <Calendar size={16} />
          <span>{fecha}</span>
        </div>
        <div className="flex items-center space-x-1">
          <User size={16} />
          <span>{usuario}</span>
        </div>
      </div>
    </div>
  );
};

export default TarjetaInfo;
```

### Ejercicio 5: Usar la Tarjeta con Datos
En [`resources/js/components/Placeholder.jsx`](resources/js/components/Placeholder.jsx):

```jsx
import TarjetaInfo from './TarjetaInfo';

// Dentro del componente:
<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <TarjetaInfo 
    titulo="Mi Primera Sesión"
    descripcion="Esta fue una sesión muy productiva donde trabajamos varios temas importantes."
    fecha="15 Oct 2024"
    usuario="Oscar"
  />
  <TarjetaInfo 
    titulo="Sesión de Seguimiento"
    descripcion="Continuamos con los temas de la sesión anterior y añadimos nuevos elementos."
    fecha="16 Oct 2024"
    usuario="Oscar"
  />
</div>
```

## 🔄 Ejercicios con Estado (React Hooks)

### Ejercicio 6: Contador Simple
Crea: `resources/js/components/Contador.jsx`

```jsx
import React, { useState } from 'react';
import { Plus, Minus, RotateCcw } from 'lucide-react';

const Contador = () => {
  const [numero, setNumero] = useState(0);

  const incrementar = () => setNumero(numero + 1);
  const decrementar = () => setNumero(numero - 1);
  const resetear = () => setNumero(0);

  return (
    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md text-center">
      <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Contador
      </h3>
      
      <div className="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-6">
        {numero}
      </div>
      
      <div className="flex justify-center space-x-3">
        <button 
          onClick={decrementar}
          className="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors"
        >
          <Minus size={20} />
        </button>
        
        <button 
          onClick={resetear}
          className="bg-gray-500 hover:bg-gray-600 text-white p-2 rounded-lg transition-colors"
        >
          <RotateCcw size={20} />
        </button>
        
        <button 
          onClick={incrementar}
          className="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg transition-colors"
        >
          <Plus size={20} />
        </button>
      </div>
    </div>
  );
};

export default Contador;
```

### Ejercicio 7: Lista de Tareas Simple
Crea: `resources/js/components/ListaTareas.jsx`

```jsx
import React, { useState } from 'react';
import { Plus, Trash2, Check } from 'lucide-react';

const ListaTareas = () => {
  const [tareas, setTareas] = useState([]);
  const [nuevaTarea, setNuevaTarea] = useState('');

  const agregarTarea = () => {
    if (nuevaTarea.trim()) {
      setTareas([...tareas, { 
        id: Date.now(), 
        texto: nuevaTarea, 
        completada: false 
      }]);
      setNuevaTarea('');
    }
  };

  const eliminarTarea = (id) => {
    setTareas(tareas.filter(tarea => tarea.id !== id));
  };

  const toggleTarea = (id) => {
    setTareas(tareas.map(tarea => 
      tarea.id === id ? { ...tarea, completada: !tarea.completada } : tarea
    ));
  };

  return (
    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md">
      <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Lista de Tareas
      </h3>
      
      {/* Input para nueva tarea */}
      <div className="flex space-x-2 mb-4">
        <input
          type="text"
          value={nuevaTarea}
          onChange={(e) => setNuevaTarea(e.target.value)}
          placeholder="Escribe una nueva tarea..."
          className="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
          onKeyPress={(e) => e.key === 'Enter' && agregarTarea()}
        />
        <button
          onClick={agregarTarea}
          className="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg transition-colors"
        >
          <Plus size={20} />
        </button>
      </div>
      
      {/* Lista de tareas */}
      <div className="space-y-2">
        {tareas.map(tarea => (
          <div key={tarea.id} className="flex items-center space-x-3 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <button
              onClick={() => toggleTarea(tarea.id)}
              className={`p-1 rounded ${tarea.completada ? 'bg-green-500 text-white' : 'bg-gray-300 dark:bg-gray-600'}`}
            >
              <Check size={16} />
            </button>
            
            <span className={`flex-1 ${tarea.completada ? 'line-through text-gray-500' : 'text-gray-900 dark:text-white'}`}>
              {tarea.texto}
            </span>
            
            <button
              onClick={() => eliminarTarea(tarea.id)}
              className="text-red-500 hover:text-red-700 p-1"
            >
              <Trash2 size={16} />
            </button>
          </div>
        ))}
      </div>
      
      {tareas.length === 0 && (
        <p className="text-gray-500 dark:text-gray-400 text-center py-4">
          No hay tareas. ¡Añade una nueva!
        </p>
      )}
    </div>
  );
};

export default ListaTareas;
```

## 🎯 Desafíos Progresivos

### Desafío 1: Personalizar el Dashboard
1. Modifica [`resources/js/components/Placeholder.jsx`](resources/js/components/Placeholder.jsx)
2. Añade tus componentes creados
3. Crea un layout de 3 columnas con diferentes widgets

### Desafío 2: Crear un Formulario de Sesión
1. Crea un componente `FormularioSesion.jsx`
2. Incluye campos: título, descripción, fecha, tipo
3. Usa `useState` para manejar los datos
4. Añade validación básica

### Desafío 3: Implementar Navegación
1. Haz que cada sección del menú muestre contenido diferente
2. Modifica [`resources/js/components/AppLayout.jsx`](resources/js/components/AppLayout.jsx)
3. Crea componentes separados para cada sección

## 📚 Recursos de Aprendizaje

### Documentación Oficial
- **React**: https://react.dev/learn
- **TailwindCSS**: https://tailwindcss.com/docs
- **Lucide Icons**: https://lucide.dev/

### Tutoriales Recomendados
- **React Hooks**: https://react.dev/reference/react
- **JavaScript Moderno**: https://javascript.info/
- **CSS Grid y Flexbox**: https://css-tricks.com/

## 🎉 ¡Siguiente Nivel!

Cuando domines estos ejercicios:
1. **Aprende React Router** para navegación real
2. **Implementa Context API** para estado global
3. **Conecta con APIs** del backend Laravel
4. **Añade animaciones** con Framer Motion
5. **Implementa formularios complejos** con validación

---

¡Recuerda: la práctica hace al maestro! 🚀
Empieza con los ejercicios simples y ve progresando gradualmente.