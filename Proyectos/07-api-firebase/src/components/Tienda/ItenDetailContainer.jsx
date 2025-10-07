
import { useState, useEffect } from 'react'
import './Styles.css'
import ItemDetail from './ItemDetail.jsx'
import { useParams } from 'react-router-dom'
import { db } from '../../firebase/config'
import { doc, getDoc } from 'firebase/firestore'
const ItenDetailContainer = () => {

    const [item, setItem] = useState(null)
    const {id} = useParams()

    useEffect(() => {
        const itemRef = doc(db, 'productos', id);
        getDoc(itemRef)
        .then((res) => {
            setItem({id: res.id, ...res.data()});
        })
        .catch((err) => {
            console.log(err);
        });
    }, [id])
    return (
        <div>
            {item && (
                <ItemDetail item={item} />
            )}
        </div>
    )
}
export default ItenDetailContainer