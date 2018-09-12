import gql from 'graphql-tag'

export const GET_MANAGEMENT_GROUPS_QUERY = gql`
    {
      readManagementGroups {
        ID
        Name
        Text
      }
    }
`

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
`




