import '../src/stylesheets/App.css'

import '../src/stylesheets/ItemListContainer.css'
import Navbar from '../src/components/Navbar/Navbar.jsx'
import Index from '../src/components/index/index.jsx'
//BrowserRouter: para que el navegador sepa que es una ruta, 
// Routes: para que el navegador sepa que es una ruta, Route: para que el navegador sepa que es una ruta, 
// Route: para que el navegador sepa que es una ruta
import {BrowserRouter, Routes, Route} from 'react-router-dom' 
import ItenListConteiner from '../src/components/Tienda/ItenListConteiner.jsx'
import ItenDetailContainer from '../src/components/Tienda/ItenDetailContainer.jsx'
import Nosotros from '../src/components/Tienda/Nosotros.jsx'
import Contacto from '../src/components/Tienda/Contacto.jsx'
import Carrito from '../src/components/Carrito/Carrito.jsx';
import CartProvider from '../src/components/Context/CartContext.jsx'
import Checkout from '../src/components/Tienda/Checkout.jsx'
function App() {
  
  return (    
    <CartProvider>
      <BrowserRouter>
        <Navbar />
        <Routes>
          
          <Route path='/' element={<ItenListConteiner />} />
          <Route path='/productos' element={<ItenListConteiner />} />
          <Route path='/item/:id' element={<ItenDetailContainer />} />
          <Route path='/nosotros' element={<Nosotros />} />
          <Route path='/productos/:categoria' element={<ItenListConteiner />} />
          <Route path='/contacto' element={<Contacto />} />
          <Route path='/carrito' element={<Carrito />} />
          <Route path='/checkout' element={<Checkout />} />
        </Routes>
      </BrowserRouter>
    </CartProvider >
  )
}

export default App
