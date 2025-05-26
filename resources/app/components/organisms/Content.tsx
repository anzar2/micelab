import React, { useState } from 'react'
import Container from '../atoms/Container'
import Button from '../atoms/Button'
import TabNavigator, { Tab } from '../molecules/TabNavigator';
import { FaTabletScreenButton } from 'react-icons/fa6';

interface Props { }

function Content(props: Props) {
    const tabButtons: Tab[] = [
        { key: "graphics", label: "Gráficos", onClick: () => console.log("graficos!")  },
        { key: "requirement", label: "Requisitos", onClick: () => console.log("graficos!")  },
        { key: "module", label: "Módulos", onClick: () => console.log("graficos!")  },
        { key: "test_case", label: "Casos de prueba", onClick: () => console.log("graficos!")  },
        { key: "bugs", label: "Bugs", onClick: () => console.log("graficos!")  },
        { key: "settings", label: "Ajustes", onClick: () => console.log("graficos!")  },
        { key: "trash", label: "Papelera", onClick: () => console.log("graficos!")  },
    ]

    const { } = props

    return <Container className='gap-1 flex flex-col grow'>
        <TabNavigator tabs={tabButtons} />
        <Container background className='grow'>
            Mostrar contenido
        </Container>
    </Container>
}

export default Content
