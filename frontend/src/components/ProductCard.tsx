import { useState } from "react";
import { ProductType } from "../types/ProductType";
function productCard({ product }: { product: ProductType }) {
  if (!product.inStock) {
    return (
      <a href={"/" + product.product_id}>
        <div className="bg-white w-full h-full grid hover:shadow-lg hover:bg-gray-300">
          <img
            src="{}"
            alt={product.name + " Image"}
            className="center aspect-square w-full h-full contrast-50"
          />
          <h3 className="font-extralight p-4 text-md">{product.name}</h3>
          <p className="text-sm">Out of stock</p>
        </div>
      </a>
    );
  }
  return (
    <a href={"/" + product.product_id}>
      <div className="bg-white w-full h-full grid hover:shadow-lg hover:bg-gray-300">
        <img
          src="{}"
          alt={product.name + " Image"}
          className="center aspect-square w-full h-full"
        />
        <h3 className="font-extralight p-4 text-md">{product.name}</h3>
        <p className="text-sm">{product.prices}</p>
        <button className="" onClick={() => console.log(product)}>
          Add to cart
        </button>
      </div>
    </a>
  );
}

export default productCard;
