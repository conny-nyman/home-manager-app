import gql from 'graphql-tag'

export const GET_SLIDES_QUERY = gql`
    {
      readSlides {
        Text
        TextWhite
        Image {
          File {
            URL
          }
        }
      }
    }
`;

