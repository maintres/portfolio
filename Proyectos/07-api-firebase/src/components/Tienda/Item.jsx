import { Link } from 'react-router-dom'
import './Styles.css'

const Item = ({producto}) => {
    return (
        <div className='item'>
            <img className='item-img' src={producto.imagen} alt={producto.nombre} />
            <div className='item-info'>
                <h4>{producto.nombre}</h4>
                <p>Precio: ${producto.precio} ARS</p>
                <p>Categoria: {producto.categoria}</p>
                <Link className='ver-mas' to={`/item/${producto.id}`}>Ver más</Link>
            </div>
        </div>
    )
}

export default Item