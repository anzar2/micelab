import { Alignment, Button, InputGroup, Label, Menu, MenuItem, Navbar, Popover, SegmentedControl, Tab, Tabs, TabsExpander } from "@blueprintjs/core"

const UserDropdown = () => {
    return <Menu>
        <MenuItem text="Settings" icon="cog" />
        <MenuItem text="Log Out" icon="log-out" />
    </Menu>
}


function App() {
    return <main>
        <Navbar>
            <Navbar.Group align={Alignment.START}>
                <Navbar.Heading className="font-medium">Anzar Games</Navbar.Heading>
                <Navbar.Divider />
                <Button icon="cube" endIcon="caret-down">{"(Vacío)"}</Button>
            </Navbar.Group>
            <Navbar.Group align={Alignment.END}>
                <div className="flex gap-2">
                    <Popover content={<UserDropdown />} placement="bottom">
                        <Button alignText="start" text="Fernando Catalán" />
                    </Popover>
                    <Button icon="help" />
                </div>
            </Navbar.Group>

        </Navbar>
        <Navbar>
            <Navbar.Group align={Alignment.START}>


                <Tabs id="TabsExample" >
                    <Tab id="gfx" title="Actividad" icon="timeline-bar-chart" />
                    <Tab id="mb" title="Requerimientos" icon="code" />
                    <Tab id="rx" title="Modulos" />
                    <Tab id="usrs" title="Miembros" icon="team" />
                    <Tab id="pap" title="Ajustes" icon="cog" />
                    <Tab id="mod" title="Papelera" icon="trash" />
                    
                    <TabsExpander />
                </Tabs>
            </Navbar.Group>
            <Navbar.Group align={Alignment.END}>

                <InputGroup placeholder="Search in Project" leftIcon="search"></InputGroup>
                <Navbar.Divider />
                <Button icon="chevron-up" variant="outlined" />
            </Navbar.Group>

        </Navbar>
    </main>
}

export default App
