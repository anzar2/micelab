import { APP_VERSION, TEAM_NAME } from "./metaTags"

function App() {
 

    return (
        <div>
            <h1 className="text-2xl">{TEAM_NAME}</h1>
            <p>Micelab {APP_VERSION}</p>
        </div>        
    )
}

export default App;


