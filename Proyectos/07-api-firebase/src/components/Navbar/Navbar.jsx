import { useState } from 'react'
import './Navbar.css'
import { Link } from 'react-router-dom'
import CartWidget from '../BarraCarrito/CartWidget.jsx'


const Navbar = () => {
    const [menuActive, setMenuActive] = useState(false)

    const toggleMenu = () => {
        setMenuActive(!menuActive)
    }

    return (
        <nav className='navbar'>
  <Link to='/' className='logo'>LOGO</Link>
  
  <div className='menu-toggle' to='/' onClick={toggleMenu}>
    <span></span>
    <span></span>
    <span></span>
  </div>

  <ul className={`menu ${menuActive ? 'active' : ''}`}>
    {/* Inicio */}
    <li><Link to='/' className='menu-link'>Inicio</Link></li>

    {/* Tienda con submenú */}
    <li className='submenu'>
      <button className='menu-link'>Todos los productos</button>
      <ul className='submenu-items'>
        <li><Link to='/productos/electronicos' className='menu-link'>Electrónicos</Link></li>
        <li><Link to='/productos/computadoras' className='menu-link'>Computadoras</Link></li>
        <li><Link to='/productos/audio' className='menu-link'>Audio</Link></li>
        <li><Link to='/productos/tablets' className='menu-link'>Tablets</Link></li>
        <li><Link to='/productos/wearables' className='menu-link'>Wearables</Link></li>
        <li><Link to='/productos/camaras' className='menu-link'>Cámaras</Link></li>
        <li><Link to='/productos/gaming' className='menu-link'>Gaming</Link></li>
        
      </ul>
    </li>

    {/* Nosotros */}
    <li><Link to='/nosotros' className='menu-link'>Nosotros</Link></li>
    <li><Link to='/contacto' className='menu-link'>Contacto</Link></li>
    <li><CartWidget /></li>
  </ul>
</nav>
    )
}

export default Navbar