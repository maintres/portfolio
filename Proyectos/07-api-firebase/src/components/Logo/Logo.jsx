
import './Logo.css'

function Logo({ isNavbar }) {
    return (
        <div className={`freeCodecamp-logo-contenedor ${isNavbar ? 'navbar-logo' : 'main-logo'}`}>
            <p className='logo'>Logo</p>
        </div>
    )
}

export default Logo;