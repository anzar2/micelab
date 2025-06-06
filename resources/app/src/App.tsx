import { Alignment, Button, Navbar } from "@blueprintjs/core"


function App() {
    return <Navbar>
    <Navbar.Group align={Alignment.START}>
        <Navbar.Heading>Anzar Games</Navbar.Heading>
        <Navbar.Divider />
        <Button className="bp5-minimal" icon="home" text="Home" />
        <Button className="bp5-minimal" icon="document" text="Files" />
    </Navbar.Group>
</Navbar>
}

export default App
