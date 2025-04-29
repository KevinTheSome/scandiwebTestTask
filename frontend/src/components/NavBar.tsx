import Cart from "./Cart";
function NavBar() {
  return (
    <nav className="bg-white grid grid-cols-3 w-screen h-1/12 pl-4 pr-4 content-center text-center items-center">
      <div className="flex content-center justify-center">
        <a href="" className="font-extralight p-4 text-2xl focus:color-green">
          Woman
        </a>
        <a href="" className="font-extralight p-4 text-2xl focus:color-green">
          Man
        </a>
        <a href="" className="font-extralight p-4 text-2xl focus:color-green">
          Kids
        </a>
      </div>
      <div className="flex items-center justify-center">
        <img
          src="src/assets/icons/shoppingBag.svg"
          className="center size-10"
          alt="green shopping bag icon"
        />
      </div>
      <div className="flex items-center justify-center">
        <Cart onCheckout={() => {}} />
      </div>
    </nav>
  );
}

export default NavBar;
