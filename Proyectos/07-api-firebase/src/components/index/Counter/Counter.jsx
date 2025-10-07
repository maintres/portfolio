import './Counter.css'
import { useState } from 'react';
const Counter = () => {
    //const [variable,funcion] = useState(valor);
    const [numero, setNumero] = useState(0);
    
    return (
        <div>
          <p>El contador vale: {numero}</p>
          <button onClick={() => setNumero(numero + 1)}>Sumar</button>
          <button onClick={() => setNumero(numero - 1)}>Restar</button>
        </div>
      );
}
export default Counter;