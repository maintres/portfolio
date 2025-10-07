import React, { useState, useEffect } from 'react'

const Pokemon = () => {

    const [pokemon, setPokemon] = useState();
    const[id,setId] = useState(1);
    useEffect(() => {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
        .then((response)=> response.json())
        .then((data) => {setPokemon(data)})
        .catch((error) => {console.error('Error:', error)});
    }, [id]);
  return (

    <div>
        <h1>Api de Pokemon</h1>
        <input type="text" value={id || name} onChange={(e) => setId(e.target.value)} />
        <button onClick={() => setId(id)}>Buscar</button>
        <p>ID: {id}</p>
        <p>Nombre: {pokemon?.name}</p>
        <img src={pokemon?.sprites.front_default} alt={pokemon?.name} />
        <p>Altura: {pokemon?.height}</p>
        <p>Peso: {pokemon?.weight}</p>
        <p>Experiencia base: {pokemon?.base_experience}</p>
        {id > 1 ? <button onClick={() => setId(id - 1)}>Anterior</button> : <button style={{backgroundColor: 'gray'}} disabled>Anterior</button>}        
        <button onClick={() => setId(id + 1)}>Siguiente</button>
    </div>
  )
}

export default Pokemon