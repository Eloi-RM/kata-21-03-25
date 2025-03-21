import './App.css'
import Home from './Home';
import Kitchen from './Kitchen';
import Menu from './Menu';
import Order from './Order';

function App() {

  return (
    <Router>
      <div className='w-full h-full absolute bg-orange-50'>
        <Header/>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/kitchen" element={<Kitchen />} />
          <Route path="/menu" element={<Menu />} />
          <Route path="/order/:orderId" element={<Order />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App
