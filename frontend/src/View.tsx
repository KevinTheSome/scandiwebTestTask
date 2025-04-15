import { useState } from "react";
import { ProductType } from "./types/ProductType";
import { gql, useQuery } from "urql";
import { useParams } from "react-router";

import Navbar from "./components/NavBar.tsx";

function View() {
  const { id } = useParams();
  const [products, setProducts] = useState<ProductType>();
  const ProductsQuery = gql`
  {
    products(product_id: "${id}") {
      name
      category
      inStock
      gallery
    }
  }
`;

  const [result, reexecuteQuery] = useQuery({
    query: ProductsQuery,
  });

  const { data, fetching, error } = result;

  if (fetching) return <p>Loading...</p>;

  if (error) return <p>Error : {error.message}</p>;

  return (
    <>
      <Navbar />
      {console.log(data)}
      <div>
        <h1>View</h1>
      </div>
    </>
  );
}

export default View;
