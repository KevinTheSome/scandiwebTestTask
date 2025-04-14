import ProductCard from "./ProductCard";
import { ProductType } from "../types/ProductType";
function ProductHolder({ products }: { products: ProductType[] }) {
  return (
    <section className="grid grid-cols-3 gap-4 w-screen h-screen p-16">
      {products.map((product: ProductType) => (
        <ProductCard key={product.id} product={product} />
      ))}
    </section>
  );
}

export default ProductHolder;
