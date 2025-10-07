import { Link } from 'react-router-dom'
import './CartWidget.css'
import { CartContext } from '../Context/CartContext.jsx';
import { useContext } from 'react';

export const CartWidget = () => {   
    const {cantidadEnCarrito} = useContext(CartContext);
    
    return (
        <div>
           <Link className="cart-container" to='/carrito'>
                <img 
                    className="cart-widget"
                    src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png" 
                    alt="cart-icon" 
                />
                {cantidadEnCarrito() > 0 && (
                    <span className="cart-widget-count">{cantidadEnCarrito()}</span>
                )}
           </Link>
        </div>
    )
}
export default CartWidget;