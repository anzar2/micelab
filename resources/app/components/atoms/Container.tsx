import React from 'react'

interface ContainerProps {
    children?:any;
    className?:string;
    background?:boolean;
}

function Container(props: ContainerProps) {
    const {
        children,
        className,
        background = false
    } = props

    return <section className={`rounded ${background && "background-primary"} ${className}`}>
        {children}
    </section>
}

export default Container
