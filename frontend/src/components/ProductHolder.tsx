import { useState } from "react";
import ProductCard from "./ProductCard";
import { ProductType } from "../types/ProductType";
function ProductHolder(products: ProductType[]) {
  return (
    <>
      {products.map((product: ProductType) => (
        <ProductCard key={product.id} product={product} />
      ))}
    </>
  );
}

export default ProductHolder;
