import { createContext, useState, useEffect } from 'react';

// Mover el contexto a un archivo separado
export const CartContext = createContext();

const carritoInicial = JSON.parse(localStorage.getItem('carrito')) || [];

export const CartProvider = ({children}) => {
    const [carrito, setCarrito] = useState(carritoInicial);

    const agregarAlCarrito = (item, cantidad) => {
        const itemAgregar = {...item, cantidad};
        const nuevoCarrito = [...carrito];
        const productoEnCarrito = nuevoCarrito.find((producto) => producto.id === itemAgregar.id);
        
        if (productoEnCarrito) {
            productoEnCarrito.cantidad += cantidad;
        } else {
            nuevoCarrito.push(itemAgregar);
        }
        
        setCarrito(nuevoCarrito);
        localStorage.setItem('carrito', JSON.stringify(nuevoCarrito));
    }

    const cantidadEnCarrito = () => {
        return carrito.reduce((acc, producto) => acc + producto.cantidad, 0);
    }
    const vaciarCarrito = () => {
      setCarrito([]);
      localStorage.removeItem('carrito');
    }

    useEffect(() => {
        localStorage.setItem('carrito', JSON.stringify(carrito));
    }, [carrito]);   
    const calcularTotal = () => {
        return carrito.reduce((acc, producto) => acc + producto.precio * producto.cantidad, 0).toFixed(2);
    }

    return (
        <CartContext.Provider value={{
            carrito, 
            agregarAlCarrito,
            cantidadEnCarrito,
            vaciarCarrito,
            calcularTotal
        }}>
            {children}
        </CartContext.Provider>
    )
}

export default CartProvider;