import { useState, useEffect, use } from "react";
import { gql, useQuery, createRequest } from "urql";
import Navbar from "./components/NavBar.tsx";
import ProductHolder from "./components/ProductHolder";

function App() {
  const ProductsQuery = gql`
    {
      products {
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

  /*
    Read this for graphql client
    https://commerce.nearform.com/open-source/urql/docs/basics/react-preact/#setting-up-the-client
  */

  return (
    <>
      <Navbar />
      {/* <ProductHolder products={data.products} /> */}
    </>
  );
}

export default App;
