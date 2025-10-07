import React, { useContext } from 'react'
import { CartContext } from '../Context/CartContext'
import './Styles.css'
import { useForm } from 'react-hook-form';
const Checkout = () => {
  const {carrito, vaciarCarrito, calcularTotal} = useContext(CartContext);
  const { register, handleSubmit } = useForm();

  const comprar = (data) => {
    if (!data.nombre || !data.email || !data.telefono) {
      alert('Por favor complete todos los campos');
      return;
    }
    
    const pedido = {
      cliente: data,
      productos: carrito,
      total: calcularTotal()
    }
    console.log(pedido);
    vaciarCarrito();
  }
  console.log(carrito);
    return (
        <div className='container'>
        <h1 className='mail-title'>Checkout</h1>
        <form className='formulario' onSubmit={handleSubmit(comprar)}>
            <input type="text" placeholder='Nombre' {...register('nombre')} />
            <input type="email" placeholder='Email' {...register('email')} />
            <input type="text" placeholder='Telefono' {...register('telefono')} />
            <button type='submit'>Comprar</button>
        </form>
    </div>
  )
}

export default Checkout