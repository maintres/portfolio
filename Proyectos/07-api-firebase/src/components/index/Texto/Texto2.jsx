import { useState,useEffect } from 'react';


const Texto2 = () => {
    const [texto, setTexto] = useState('');
    
    useEffect(() => {
        console.log("Componente montado");
        return () => {
            console.log("Componente desmontado");
        }
        
    }, []);
    useEffect(() => {
        console.log("Componente actualizado");
    }, [texto]);



    return (
        <div>
            <input type="text" placeholder='Escribe algo' onChange={(e) => setTexto(e.target.value)}/>
            <h1>{texto}</h1>
            <hr />
        </div>
    )
}
export default Texto2;