import Navbar from '../molecules/Navbar'
import Container from '../atoms/Container'
import Sidebar from '../organisms/Sidebar';
import Content from '../organisms/Content';

interface LayoutProps {
    children?: any;
    margin?: string;
}

function Layout(props: LayoutProps) {
    const {
        children
    } = props

    return <main className={`h-screen w-screen flex flex-col gap-1 p-1`}>
        <Navbar></Navbar>
        <Container className={`flex gap-1 grow`}>
            <Sidebar>
                BUTTON_LIST
            </Sidebar>
            <Content>

            </Content>
        </Container>

    </main>
}

export default Layout
