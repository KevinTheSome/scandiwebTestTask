import { useState } from "react";
import { ProductType } from "../types/ProductType";
function productCard({ product }: { product: ProductType }) {
  return (
    <div className="bg-white w-full h-full grid hover:shadow-lg hover:bg-gray-300">
      <img src="{}" alt="{}" />
      <h3 className="font-extralight p-4 text-md">{product.name}</h3>
      <p className="text-sm">{product.prices}</p>
      <button className="" onClick={() => console.log(product)}>
        Add to cart
      </button>
    </div>
  );
}

export default productCard;
