import { useState, useEffect } from "react";

function PokemonList() {
  const [data, setData] = useState([]);
  const [search, setSearch] = useState("");
  const [showDropdown, setShowDropdown] = useState(false);
  const [id, setId] = useState(1);
  const [pokemon, setPokemon] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetch("https://pokeapi.co/api/v2/pokemon?limit=10000&offset=0")
      .then((response) => response.json())
      .then((data) => setData(data.results))
      .catch((error) => console.log(error));
  }, []);

  
  // Filtrar por los que comienzan con el texto ingresado
  const filteredData = data.filter((pokemon) =>
    pokemon.name.toLowerCase().startsWith(search.toLowerCase())
  );

  // Manejar selección
  const handleSelect = async (name) => {
    setSearch(name);
    setShowDropdown(false);
    
    try {
      setLoading(true);
      setError(null);
      const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${name.toLowerCase()}`);
      if (!response.ok) {
        throw new Error('Pokémon no encontrado');
      }
      const data = await response.json();
      setPokemon(data);
      setId(data.id);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={{ fontFamily: "Arial", padding: "20px" }}>
      <div style={{ width: "250px", marginBottom: "20px" }}>
        <h2>Buscar Pokémon</h2>
        <input
          type="text"
          placeholder="Buscar Pokémon..."
          value={search}
          onChange={(e) => {
            setSearch(e.target.value);
            setShowDropdown(true);
          }}
          onFocus={() => setShowDropdown(true)}
          style={{
            width: "100%",
            padding: "8px",
            marginBottom: "0",
            borderRadius: "5px",
            border: "1px solid #ccc",
          }}
        />

        {/* Dropdown solo si hay texto y showDropdown es true */}
        {search && showDropdown && filteredData.length > 0 && (
          <ul
            style={{
              listStyle: "none",
              padding: 0,
              margin: 0,
              maxHeight: "200px",
              overflowY: "auto",
              border: "1px solid #ccc",
              borderTop: "none",
              borderRadius: "0 0 5px 5px",
              backgroundColor: "#222",
              position: "absolute",
              width: "250px",
              zIndex: 1000,
            }}
          >
            {filteredData.map((pokemon) => (
              <li
                key={pokemon.name}
                onClick={() => handleSelect(pokemon.name)}
                style={{
                  padding: "8px",
                  borderBottom: "1px solid #444",
                  cursor: "pointer",
                  color: "#fff",
                }}
              >
                {pokemon.name}
              </li>
            ))}
          </ul>
        )}
      </div>
        {pokemon && !loading && !error && (
          <div style={{ 
            padding: "20px", 
            border: "1px solid #ccc", 
            borderRadius: "10px",
            backgroundColor: "#222" 
          }}>
            <img 
              src={pokemon.sprites.front_default} 
              alt={pokemon.name}
              style={{ 
                width: "150px", 
                height: "150px",
                display: "block",
                margin: "0 auto"                
              }}
            />
            <h3 style={{ textAlign: "center", textTransform: "capitalize" }}>{pokemon.name}</h3>
            <div style={{ marginTop: "20px" }}>
              <p><strong>ID:</strong> {id}</p>
              <p><strong>Altura:</strong> {pokemon.height / 10} m</p>
              <p><strong>Peso:</strong> {pokemon.weight / 10} kg</p>
              <p><strong>Experiencia base:</strong> {pokemon.base_experience}</p>
            </div>           
            
          </div>
        )}
      </div>
  );
}

export default PokemonList;
