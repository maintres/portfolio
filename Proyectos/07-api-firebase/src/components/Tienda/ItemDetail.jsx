import './Styles.css'
import ItemCount from './ItemCount.jsx'
import { useState, useContext } from 'react';
import { CartContext } from '../Context/CartContext.jsx';

const ItemDetail = ({item}) => {
    const{carrito, agregarAlCarrito} = useContext(CartContext);
    console.log(carrito);
    const [cantidad, setCantidad] = useState(1);

     const handleRestar = () => {
        cantidad > 1 && setCantidad(cantidad - 1);
    }

    const handleSumar = () => {
        cantidad < 10 && setCantidad(cantidad + 1);
    }
    
    return (
        <div className='container'>
            <div className='producto-detalle'>
                <div className='producto-imagen'>
                    <img src={item.imagen} alt={item.nombre} />
                </div>
                <div className='producto-info'>
                    <h3 className='titulo'>{item.nombre}</h3>
                    <p className='descripcion'>{item.descripcion}</p>
                    <p className='categoria'>Categoria: {item.categoria}</p>
                    <p className='precio'>Precio: ${item.precio} ARS</p>
                    <ItemCount 
                        cantidad={cantidad} 
                        handleRestar={handleRestar} 
                        handleSumar={handleSumar} 
                        handleAgregar={() => agregarAlCarrito(item,cantidad)} 
                    />
                </div>
            </div>
        </div>        
    )
}

export default ItemDetail