import './Styles.css'
import Item from './Item.jsx'
const ItemList = ({productos}) => {
    return (
        <div className='productos-container'>            
            <h2 className='main-title'>Productos</h2>
            <div className='productos'>
                {productos.map((producto) => (
                    < Item key={producto.id} producto={producto} />
                ))}
            </div>
        </div>
    )
}

export default ItemList