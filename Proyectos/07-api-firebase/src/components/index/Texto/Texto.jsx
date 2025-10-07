import { useState } from 'react';

const Texto = () => {
    const [show, setShow] = useState(true);
    const mostrar = () => {
        setShow(!show);
    }
    return (
        <div>
            {show===true ? <h1>Hola mundo</h1> : <h1>Adios mundo</h1>}
            <button onClick={mostrar}>{show ===true ? 'Ocultar' : 'Mostrar'}</button>
            <hr />
        </div>
    )
}
export default Texto;