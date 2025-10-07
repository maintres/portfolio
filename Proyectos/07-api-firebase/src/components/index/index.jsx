import Logo from '../Logo/Logo.jsx'
import {Usuario} from './Usuario/Usuario.jsx'
import Counter from './Counter/Counter.jsx'
import Texto from './Texto/Texto.jsx'
import Texto2 from './Texto/Texto2.jsx'
import '../../stylesheets/App.css'
import ItemListContainer from './ItemListContainer/ItemListContainer.jsx'
import Pokemon from './Pokemon/Pokemon.jsx'
import PokemonList from './Pokemon/PokemonList.jsx'


const Index = () => {
    return (
        <div className='App'> 
            <Logo />
            <Usuario nombre='Juan' correo='juan@gmail.com' rol='Admin' />      
            <div className='itemListContainer'>        
                <Counter />
                <Texto />   
                <Texto2 />    
            </div>
            <ItemListContainer />
            <div className='itemListContainer'>
                <Pokemon />        
            </div>
            <div className='itemListContainer'>
                <PokemonList />
            </div>
      </div>
    )
}

export default Index