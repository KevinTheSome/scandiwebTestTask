import React, { useState, useEffect, useRef } from "react";

const initialCartItems = [
  {
    id: 1,
    name: "Running Short",
    price: 50.0,
    size: "M",
    availableSizes: ["XS", "S", "M", "L"],
    color: "Gray",
    availableColors: ["#4B5563", "#1F2937", "#3B82F6"], // Hex codes for Gray, Dark Gray, Blue
    colorNames: ["Gray", "Dark Gray", "Blue"], // Corresponding names
    quantity: 1,
    imageUrl: "https://placehold.co/100x100/e2e8f0/4a5568?text=Shorts", // Placeholder image
  },
  {
    id: 2,
    name: "Wayfarer",
    price: 75.0,
    size: "S",
    availableSizes: ["S", "M"],
    color: "Black",
    availableColors: ["#000000", "#CA8A04", "#0EA5E9"], // Hex codes for Black, Gold, Sky Blue
    colorNames: ["Black", "Gold", "Sky Blue"], // Corresponding names
    quantity: 2,
    imageUrl: "https://placehold.co/100x100/e2e8f0/4a5568?text=Glasses", // Placeholder image
  },
];

// Cart Item Sub-Component (Internal to ShoppingCartDropdown)
// Props:
// - item: The cart item object
// - onUpdateItem: Function to call when item details (qty, size, color) change
// - onRemoveItem: Function to call when the remove button is clicked
function CartItem({ item, onUpdateItem, onRemoveItem }) {
  // Handler for changing quantity
  const handleQuantityChange = (change) => {
    const newQuantity = item.quantity + change;
    // Prevent quantity from going below 1
    if (newQuantity >= 1) {
      onUpdateItem(item.id, { ...item, quantity: newQuantity });
    }
    // Optionally, allow setting quantity to 0 to remove, but currently prevents going below 1.
    // else if (newQuantity === 0) {
    //   onRemoveItem(item.id);
    // }
  };

  // Handler for changing size
  const handleSizeChange = (newSize) => {
    onUpdateItem(item.id, { ...item, size: newSize });
  };

  // Handler for changing color
  const handleColorChange = (newColorHex, newColorName) => {
    // Pass both the hex and name if needed by the parent state
    onUpdateItem(item.id, {
      ...item,
      color: newColorName,
      selectedColorHex: newColorHex,
    });
  };

  return (
    <div className="flex items-start py-4 border-b border-gray-200 last:border-b-0">
      {/* Item Image */}
      <img
        src={item.imageUrl}
        alt={item.name}
        className="w-20 h-20 object-cover rounded-md mr-4 flex-shrink-0"
        // Basic fallback placeholder
        onError={(e) => {
          e.target.onerror = null;
          e.target.src =
            "https://placehold.co/100x100/cccccc/969696?text=Image+Not+Found";
        }}
      />

      {/* Item Details */}
      <div className="flex-grow">
        <div className="flex justify-between items-start mb-1">
          <h4 className="font-medium text-sm text-gray-800">{item.name}</h4>
          {/* Remove Item Button */}
          <button
            onClick={() => onRemoveItem(item.id)}
            className="text-gray-400 hover:text-red-500 transition-colors p-1 -m-1" // Added padding for easier clicking
            aria-label={`Remove ${item.name}`}
          >
            <p>X</p>
          </button>
        </div>
        <p className="text-sm text-gray-600 mb-2">${item.price.toFixed(2)}</p>

        {/* Size Selector */}
        <div className="mb-2">
          <span className="text-xs text-gray-500 mr-2">Size:</span>
          <div className="inline-flex items-center space-x-1">
            {item.availableSizes.map((size) => (
              <button
                key={size}
                onClick={() => handleSizeChange(size)}
                className={`px-2 py-0.5 border rounded text-xs transition-colors ${
                  item.size === size
                    ? "bg-gray-900 text-white border-gray-900" // Selected style
                    : "bg-white text-gray-700 border-gray-300 hover:bg-gray-100" // Default style
                }`}
                aria-label={`Select size ${size}`}
              >
                {size}
              </button>
            ))}
          </div>
        </div>

        {/* Color Selector */}
        <div className="mb-3">
          <span className="text-xs text-gray-500 mr-2">Color:</span>
          <div className="inline-flex items-center space-x-1.5">
            {item.availableColors.map((colorHex, index) => (
              <button
                key={colorHex}
                onClick={() =>
                  handleColorChange(colorHex, item.colorNames[index])
                }
                className={`w-5 h-5 rounded-full border-2 transition-all ${
                  // Check against the color name for selection state
                  item.color === item.colorNames[index]
                    ? "border-gray-700 ring-1 ring-offset-1 ring-gray-500" // Selected style
                    : "border-gray-300 hover:border-gray-500" // Default style
                }`}
                style={{ backgroundColor: colorHex }}
                aria-label={`Select color ${item.colorNames[index]}`}
              >
                {/* Visual cue for selected state (optional) */}
                {/* {item.color === item.colorNames[index] && <span className="block w-2 h-2 rounded-full bg-white mix-blend-difference"></span>} */}
              </button>
            ))}
          </div>
        </div>

        {/* Quantity Control */}
        <div className="flex items-center">
          <span className="text-xs text-gray-500 mr-2">Qty:</span>
          <div className="flex items-center border border-gray-300 rounded">
            <button
              onClick={() => handleQuantityChange(-1)}
              className="px-2 py-0.5 text-gray-600 hover:bg-gray-100 rounded-l transition-colors disabled:opacity-50"
              disabled={item.quantity <= 1} // Disable minus button at quantity 1
              aria-label="Decrease quantity"
            >
              <p>-</p>
            </button>
            <span className="px-3 py-0.5 text-sm text-gray-800 border-l border-r border-gray-300 tabular-nums">
              {" "}
              {item.quantity}
            </span>
            <button
              onClick={() => handleQuantityChange(1)}
              className="px-2 py-0.5 text-gray-600 hover:bg-gray-100 rounded-r transition-colors"
              aria-label="Increase quantity"
            >
              <p>+</p>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

// Main Shopping Cart Dropdown Component
// Props: (Optional - for integrating with external state)
// - initialItems: An array of cart items to initialize with
// - onCheckout: A function to call when the "Place Order" button is clicked
function Cart({ initialItems = initialCartItems, onCheckout }) {
  const [isOpen, setIsOpen] = useState(false); // State for dropdown visibility
  // Initialize state with passed initialItems or the mock data
  const [cartItems, setCartItems] = useState(initialItems); // State for cart items
  const dropdownRef = useRef(null); // Ref for detecting clicks outside

  // Calculate total items based on current cartItems state
  const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);

  // Calculate total price based on current cartItems state
  const totalPrice = cartItems.reduce(
    (sum, item) => sum + item.price * item.quantity,
    0
  );

  // Toggle dropdown visibility
  const toggleDropdown = () => {
    setIsOpen(!isOpen);
  };

  // Effect to handle clicks outside the dropdown to close it
  useEffect(() => {
    function handleClickOutside(event) {
      // Check if the click is outside the dropdownRef element AND not on the toggle button
      // We identify the toggle button using its data-testid attribute
      const isToggleButton = event.target.closest(
        '[data-testid="cart-toggle-button"]'
      );
      if (
        dropdownRef.current &&
        !dropdownRef.current.contains(event.target) &&
        !isToggleButton
      ) {
        setIsOpen(false); // Close dropdown
      }
    }

    // Add event listener when the component mounts (and dropdown might be open)
    document.addEventListener("mousedown", handleClickOutside);
    // Clean up the event listener when the component unmounts
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
    // Dependency array includes dropdownRef to ensure the ref is current,
    // though technically it might not be needed if the ref itself doesn't change.
  }, [dropdownRef]);

  // Update item details (quantity, size, color) in the cart state
  const handleUpdateItem = (itemId, updatedDetails) => {
    setCartItems((currentItems) =>
      currentItems.map((item) =>
        item.id === itemId ? { ...item, ...updatedDetails } : item
      )
    );
    // Add logic here to persist changes (e.g., API call, localStorage) if needed
  };

  // Remove item from the cart state
  const handleRemoveItem = (itemId) => {
    setCartItems((currentItems) =>
      currentItems.filter((item) => item.id !== itemId)
    );
    // Add logic here to persist removal (e.g., API call, localStorage) if needed
  };

  // Handle the checkout process
  const handlePlaceOrder = () => {
    // If an onCheckout prop function is provided, call it
    if (onCheckout) {
      onCheckout(cartItems); // Pass cart items to the handler
    } else {
      // Default behavior if no onCheckout handler is provided
      alert(
        `Proceeding to checkout with ${totalItems} items for $${totalPrice.toFixed(
          2
        )}!`
      );
    }
    setIsOpen(false); // Close the dropdown after initiating checkout
  };

  return (
    // The main container is relative for positioning the absolute dropdown
    <div className="relative font-sans">
      {" "}
      {/* Use 'font-sans' or your preferred font family */}
      {/* Cart Icon Button - Toggles the dropdown */}
      <button
        onClick={toggleDropdown}
        className="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-full transition-colors"
        aria-label={`Shopping Bag: ${totalItems} items`}
        aria-expanded={isOpen} // Indicate dropdown state for accessibility
        data-testid="cart-toggle-button" // Test ID for click outside logic and testing
      >
        <img src="src/assets/icons/shoppingCart.svg" alt="Shopping Cart Icon" />
        {/* Badge showing the number of items */}
        {totalItems > 0 && (
          <span className="absolute top-0 right-0 block h-4 w-4 transform -translate-y-1 translate-x-1 rounded-full bg-red-500 text-white text-xs flex items-center justify-center pointer-events-none">
            {" "}
            {/* pointer-events-none so it doesn't interfere with button click */}
            {totalItems}
          </span>
        )}
      </button>
      {/* Dropdown Panel - Conditionally rendered based on 'isOpen' state */}
      {isOpen && (
        <div
          ref={dropdownRef} // Assign ref for click outside detection
          className="absolute right-0 mt-2 w-80 sm:w-96 bg-white rounded-lg shadow-xl z-50 border border-gray-200 overflow-hidden flex flex-col" // Use flex-col for structure
          role="dialog" // Role for accessibility
          aria-modal="true" // Indicates it's a modal dialog
          aria-labelledby="cart-heading" // Associates heading for screen readers
        >
          {/* Inner container for padding and scrolling */}
          <div className="p-4 flex-shrink-0">
            {" "}
            {/* Header padding */}
            {/* Dropdown Header */}
            <h3
              id="cart-heading"
              className="text-lg font-semibold text-gray-900 mb-4"
            >
              My Bag{" "}
              <span className="text-sm font-normal text-gray-500">
                ({totalItems} items)
              </span>
            </h3>
          </div>

          {/* Cart Items List - Scrollable */}
          <div className="flex-grow overflow-y-auto max-h-80 px-4">
            {" "}
            {/* Scrollable area with padding */}
            {cartItems.length === 0 ? (
              <p className="text-center text-gray-500 py-6">
                Your bag is empty.
              </p>
            ) : (
              <div className="space-y-4">
                {" "}
                {/* Add space between items */}
                {cartItems.map((item) => (
                  <CartItem
                    key={item.id}
                    item={item}
                    onUpdateItem={handleUpdateItem}
                    onRemoveItem={handleRemoveItem}
                  />
                ))}
              </div>
            )}
          </div>

          {/* Dropdown Footer - Only shown if there are items */}
          {cartItems.length > 0 && (
            <div className="bg-gray-50 p-4 border-t border-gray-200 flex-shrink-0">
              {" "}
              {/* Footer padding and border */}
              {/* Total Price Display */}
              <div className="flex justify-between items-center mb-4">
                <span className="text-md font-medium text-gray-800">Total</span>
                <span className="text-lg font-semibold text-gray-900">
                  ${totalPrice.toFixed(2)}
                </span>
              </div>
              {/* Place Order Button */}
              <button
                className="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-70"
                onClick={handlePlaceOrder} // Use the checkout handler
                disabled={totalItems === 0} // Disable if cart is empty
              >
                PLACE ORDER
              </button>
            </div>
          )}
          {/* Optional: Add a close button inside the dropdown */}
          {/* <button onClick={() => setIsOpen(false)} className="absolute top-2 right-2 p-1 text-gray-400 hover:text-gray-600"> <X size={18}/> </button> */}
        </div>
      )}
    </div>
  );
}

// Export the component for use in other files
export default Cart;
