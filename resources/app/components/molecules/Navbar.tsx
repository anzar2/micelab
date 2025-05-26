import { header } from 'framer-motion/client'
import React from 'react'
import Select from '../atoms/Select'

interface Props {}

function Navbar(props: Props) {
    const {} = props

    return <header className='background-primary p-1'>
        <nav className='flex gap-2'>
            <h2>Micelab</h2>
        </nav>
    </header>
}

export default Navbar
