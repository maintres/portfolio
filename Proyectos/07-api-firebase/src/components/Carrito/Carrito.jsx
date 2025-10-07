import './Carrito.css'
import { useContext } from 'react'
import { CartContext } from '../Context/CartContext.jsx'
import { Link } from 'react-router-dom'

const Carrito = () => {
    const { carrito, vaciarCarrito, calcularTotal } = useContext(CartContext)

    return (
        <div className='shopping-cart-container'>
            <h1 className='shopping-cart-titulo'>Carrito de Compras</h1>

            {carrito.length === 0 ? (
                <div className='shopping-cart-vacio'>
                    <h2>El carrito está vacío</h2>
                </div>
            ) : (
                <div className='shopping-cart-layout'>
                    <div className='shopping-cart-productos'>
                        <div className='shopping-cart-lista'>
                            {carrito.map((item) => (
                                <div key={item.id} className='shopping-cart-item'>
                                    <div className='shopping-cart-item-info'>
                                        <img src={item.imagen} alt={item.nombre} />
                                        <div className='shopping-cart-item-details'>
                                            <h3 style={{color: '#fff'}}>{item.nombre}</h3>
                                            <div className='shopping-cart-item-price'>
                                                <span className='price'>${item.precio.toFixed(2)}</span>
                                                <span className='quantity'>Cantidad: {item.cantidad}</span>
                                            </div>
                                            <div className='shopping-cart-item-subtotal'>
                                                Subtotal: ${(item.precio * item.cantidad).toFixed(2)}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className='shopping-cart-resumen'>
                        <h3>Resumen de la Compra</h3>
                        <ul className='shopping-cart-lista-resumen'>
                            <li>
                                <span>Subtotal:</span>
                                <span>${calcularTotal()}</span>
                            </li>
                            <li>
                                <span>IVA (21%):</span>
                                <span>${(calcularTotal() * 0.21).toFixed(2)}</span>
                            </li>
                            <li className='shopping-cart-total'>
                                <span>Total Final:</span>
                                <span>${(calcularTotal() * 1.21).toFixed(2)}</span>
                            </li>
                        </ul>
                        <Link to='/checkout'>
                            <button className='shopping-cart-btn-finalizar'>
                                Finalizar Compra
                            </button>
                        </Link>
                        <button className='shopping-cart-btn-vaciar' onClick={vaciarCarrito}>
                            Vaciar Carrito
                        </button>

                    </div>
                </div>
            )}
        </div>
    )
}

export default Carrito
