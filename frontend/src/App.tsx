import { useState } from "react";
import { gql, useQuery } from "urql";
import Navbar from "./components/NavBar.tsx";
import ProductHolder from "./components/ProductHolder";
import { ProductType } from "./types/ProductType.ts";

function App() {
  const ProductsQuery = gql`
    {
      products {
        product_id
        name
        category
        inStock
        gallery {
          image_url
        }
        prices {
          amount
          currency {
            symbol
          }
        }
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

  if (fetching) return <p>Loading...</p>;

  if (error) return <p>Error : {error.message}</p>;

  return (
    <>
      <Navbar />
      <ProductHolder products={data.products} />
    </>
  );
}

export default App;
