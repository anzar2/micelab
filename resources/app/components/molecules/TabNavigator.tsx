import React, { useState } from 'react'
import Container from '../atoms/Container';
import Button from '../atoms/Button';

interface TabNavigatorProps {
    tabs?: Tab[]
}



function TabNavigator(props: TabNavigatorProps) {
    const [selectedTab, setTab] = useState("");

    const handleClick = (tab: string, callback:any) => {
        setTab(tab);
        callback();
    }
    const { tabs } = props

    return (
        <Container className='flex gap-1'>
            {tabs!.map((button, index) => {
                let selected = selectedTab == button.key;
                return <Button key={button.key} label={button.label} onClick={() => { handleClick(button.key, button.onClick) }} variant={selected ? "tab-selected" : "tab"} />
            })}
        </Container>
    )
}


export interface Tab {
    key:string;
    label:string;
    onClick:any;
}

export default TabNavigator
