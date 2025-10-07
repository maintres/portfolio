import { useState, useEffect } from 'react';
import '../../../stylesheets/ItemListContainer.css'
import pedirProductos from '../../index/pedirProductos.js';

const ItemListContainer = () => {
//productos → guarda la lista de productos.
//setProductos → función que actualiza ese estado.
//Inicialmente está vacío ([]).
//useState → significa que estamos usando el estado de react que guarda la lista de productos.
    const [productos, setProductos] = useState([]);    
    useEffect(()=>{
        pedirProductos()
        .then((res)=>{
            setProductos(res);
        })
        .catch((err)=>{
            console.log(err);
        })
    },[])
    return (
        <div className='itemListContainer'>
            <h1>ItemListContainer</h1>
            {productos.map((producto)=>(
                <div key={producto.id} className='itemList'>
                    <h2>{producto.nombre}</h2>
                    <p>{producto.descripcion}</p>
                    <p>Precio: ${producto.precio} ARS</p>
                    <img src={producto.imagen} alt={producto.nombre} />
                </div>
            ))}
        </div>
    )
}
export default ItemListContainer;