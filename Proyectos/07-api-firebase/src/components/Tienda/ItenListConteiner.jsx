import { useEffect, useState } from 'react';
import './Styles.css'
import ItemList from './ItemList.jsx'
import { useParams } from 'react-router-dom'
import { db } from '../../firebase/config'
import { collection, getDocs, query, where } from 'firebase/firestore'

const ItemListContainer = () => {
  const [productos, setProductos] = useState([]);
  const { categoria } = useParams();

  useEffect(() => {
    const fetchProductos = async () => {
      try {
        const productosRef = collection(db, 'productos');
        const q = categoria 
          ? query(productosRef, where('categoria', '==', categoria.charAt(0).toUpperCase() + categoria.slice(1)))
          : productosRef;
        
        const querySnapshot = await getDocs(q);
        const productosData = querySnapshot.docs.map(doc => ({
          id: doc.id,
          ...doc.data()
        }));
        
        setProductos(productosData);
      } catch (error) {
        console.error("Error al cargar productos:", error);
      }
    };

    fetchProductos();
  }, [categoria]);
  
  return (
    <div className='itemListContainer2'>
      <h1>{categoria ? `Tienda - ${categoria}` : 'Todos los productos'}</h1>
      <ItemList productos={productos} />
    </div>
  )
}

export default ItemListContainer